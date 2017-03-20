<?php

/**
 * @ Excel扩展类
 * @ Excel 导入/导出
 * @ Author Jamlin@163.com
 * @ Date 2015-6
 */
class Excel
{
    //配置
    static public $config = array(
        'remove' => false,        //是否上传后删除文件
        'filename' => 'filename', //文件名称
        'rootpath' => './Public', //上传主目录
        'savepath' => '/Uploads/Files/Excel/',//上传子目录
        'filetype' => array('xls', 'xlsx'),//限制上传文件类型
        'fields' => array(),//导入/导出文件字段[导入时为数据字段,导出时为字段标题]
        'datefield' => array(),//上传带日期时间格式字段
        'data' => array(), //导出Excel的数组
        'savename' => '',  //导出文件名称
        'title' => '',     //导出文件栏目标题
        'suffix' => 'xlsx',//文件格式
    );

    //初始化
    public function __construct($config = array())
    {

        if (empty($config['fields'])) exit('未设置字段集！');
        //设置配置项
        foreach ($config as $key => $value) {
            if (!empty($value)) {
                static::$config[$key] = $value;
            }
        }
    }

    //上传文件
    protected function UploadFile()
    {
        $filename = self::$config['filename'];
        if (!empty($_FILES[$filename]['name'])) {
            $file_types = explode(".", $_FILES[$filename]['name']);
            $file_type = $file_types[count($file_types) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (!in_array(strtolower($file_type), self::$config['filetype'])) {
                exit('您上传的不是Excel文件，重新上传！');
            }
            /*设置上传路径*/
            //实例化上传类
            $config = array('maxSize' => 3145728,
                'rootPath' => self::$config['rootpath'],
                'savePath' => self::$config['savepath'],
                'saveName' => array('uniqid', time()),
                'exts' => self::$config['filetype'],
                'autoSub' => true,
                'subName' => array('date', 'Ym'),
                'hash' => true,
            );
            $upload = new \Think\Upload($config);
            //开始上传
            $info = $upload->uploadOne($_FILES[$filename]);
            //上传错误时
            if (!$info) exit($upload->getError());
            $rootpath = ltrim($config['rootPath'], '.');
            $full_path = $rootpath . $info['savepath'] . $info['savename'];
            return array('filepath' => $full_path, 'filename' => $info['savename']);
        }
    }


    //导入excel内容转换成数组
    public function import()
    {
        //上传文件
        $file = $this->UploadFile();
        $filePath = ltrim($file['filepath'], '/');
        //解析Excel
        /*导入phpExcel核心类 */
        Vendor("PHPExcel.PHPExcel");
        Vendor("PHPExcel.PHPExcel.IOFactory");
        $PHPExcel = new \PHPExcel();
        // PHPExcel_Settings::setCacheStorageMethod();
        // PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
        set_time_limit(0);//设置程序执行时间
        /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
        $PHPReader = \PHPExcel_IOFactory::createReader('Excel2007');
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = \PHPExcel_IOFactory::createReader('Excel5');
            if (!$PHPReader->canRead($filePath)) {
                exit('no Excel');
            }
        }

        $PHPExcel = $PHPReader->load($filePath, 'gb2312');
        $currentSheet = $PHPExcel->getSheet(0);  //读取excel文件中的第一个工作表
        $allColumn = $currentSheet->getHighestColumn(); //取得最大的列号
        $allRow = $currentSheet->getHighestRow(); //取得一共有多少行
        //声明数组
        $data = array();
        //列标识数组
        $letters_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $fields = self::$config['fields'];
        $letters_arr = array_slice($letters_arr, 0, count($fields));
        /**从第二行开始输出，因为excel表中第一行为列名*/
        $i = 0;
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
            /**从第A列开始输出*/
            for ($currentColumn = 0; $currentColumn <= array_search($allColumn, $letters_arr); $currentColumn++) {
                $val = $PHPExcel->getActiveSheet()->getCell("{$letters_arr[$currentColumn]}{$currentRow}")->getValue();
                if (!empty($val)) {//富文本转换字符串
                    if ($val instanceof PHPExcel_RichText) {
                        $val = $val->__toString();
                    }
                    //转换日期格式
                    if (!empty(self::$config['datefield']) && in_array($fields[$currentColumn], self::$config['datefield']))
                        $val = $this->excelTime($val);
                    $data[$i][$fields[$currentColumn]] = $val;
                    /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
                    //echo iconv('utf-8','gb2312', $val)."\t";
                }
            }
            $i++;
        }
        //删除文件
        if (self::$config['remove']) {
            $dfile = '.' . $file['filepath'];
            if (file_exists($dfile)) {
                unlink($dfile);
            }
        }
        return $data;
    }

    //转换时间格式为标准格式
    protected function excelTime($date, $time = false)
    {
        if (function_exists('GregorianToJD')) {
            if (is_numeric($date)) {
                $jd = GregorianToJD(1, 1, 1970);
                $gregorian = JDToGregorian($jd + intval($date) - 25569);
                $date = explode('/', $gregorian);
                $date_str = str_pad($date [2], 4, '0', STR_PAD_LEFT)
                    . "-" . str_pad($date [0], 2, '0', STR_PAD_LEFT)
                    . "-" . str_pad($date [1], 2, '0', STR_PAD_LEFT)
                    . ($time ? " 00:00:00" : '');
                return $date_str;
            }
        } else {
            $date = $date > 25568 ? $date + 1 : 25569;
            /*There was a bug if Converting date before 1-1-1970 (tstamp 0)*/
            $ofs = (70 * 365 + 17 + 2) * 86400;
            $date = date("Y-m-d", ($date * 86400) - $ofs) . ($time ? " 00:00:00" : '');
        }
        return $date;
    }


// @ 导出Excel表格
// @ Params data[*导出二维数组]
// @ Params fields[定义第一行标题,默认为数组字段]
// @ params filename[导出的文件名称，默认为日期名称]
// @ Params title[第一张表标题]
// @ Params suffix[文件格式，默认为xlsx] 
    static public function export($data, $fields = null, $savename = null, $title = 'Sheet1', $suffix = 'xlsx')
    {
        //导出数据
        $data = !empty(self::$config['data']) ? self::$config['data']
            : (!empty($data) ? $data : exit('导出数据为空！'));
        //第一列字段标题
        $fields = !empty(self::$config['fields']) ? self::$config['fields']
            : (!empty($fields) ? $fields : null);
        //文件名称
        $savename = !empty(self::$config['savename']) ? self::$config['savename']
            : (!empty($savename) ? $savename : date('Y-m-d_H_I_s'));
        //表名称
        $title = !empty(self::$config['title']) ? self::$config['title'] : $title;
        //保存文件格式
        $suffix = !empty(self::$config['suffix']) ? self::$config['suffix'] : $suffix;
        //导出的文件全称
        $savename = "{$savename}.{$suffix}";
        /* 实例化类 */
        /*导入phpExcel核心类 */
        Vendor("PHPExcel.PHPExcel");
        $suffix = 'xlsx' ?
            Vendor("PHPExcel.PHPExcel.Writer.Excel2007")
            : Vendor("PHPExcel.PHPExcel.Writer.Excel5");
        $objPHPExcel = new \PHPExcel();

        /* 设置输出的excel文件为2007兼容格式或2003格式 */
        if ($suffix = 'xlsx') {
            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);//2007格式
        } else {
            $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);//非2007格式
        }
        /* 设置当前的sheet */
        $objPHPExcel->setActiveSheetIndex(0);
        $objActSheet = $objPHPExcel->getActiveSheet();
        /*设置宽度*/
        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
        /* sheet标题 */
        $objActSheet->setTitle($title);
        //列标识数组
        $letters_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $i = 2;
        foreach ($data as $value) {
            /* excel文件内容 */
            $j = 0;
            $index = 0;
            foreach ($value as $key => $value2) {
                if ($i == 2) {//设置第一行标题
                    $objActSheet->setCellValue("{$letters_arr[$j]}1", !empty($fields[$index]) ? $fields[$index] : $key);
                    $index++;
                }
                //$value2 = iconv("gb2312","utf-8",$value2);
                $objActSheet->setCellValue($letters_arr[$j] . $i, $value2);
                $j++;
            }
            $i++;
        }


        /* 生成到浏览器，提供下载 */
        ob_end_clean();  //清空缓存
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment;filename='{$savename}'");
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }
}

?>