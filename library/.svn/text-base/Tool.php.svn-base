<?php
class Library_Tool
{
    /**
     * 
     * 取得語系號碼
     * @param string $lang
     * 
     * @return int $langNum
     */
    public static function getLanguageNumber ($lang)
    {
        $langNum = 0;
        switch ($lang) {
            case 'tw':
                $langNum = 1;
                break;
            case 'cn':
                $langNum = 2;
                break;
            case 'jp':
                $langNum = 3;
                break;
            case 'en':
                $langNum = 4;
                break;
        }
        return $langNum;
    }
    /**
     * 利用sendmail寄送可以附檔的信件(如果沒有附檔，就不用傳入附檔的參數)。
     * @param array $ary_addTo		收件人信箱(email)和暱稱(nickName)
     * @param string $subject		信件標題
     * @param string $bodyInHTML	信件內文(HTML格式，也可以接受純文字格式的資料)
     * @param string $from			寄件人信箱(email)和暱稱(nickName)
     * @param string $fileName		附檔的檔名
     * @param string $filePath		附檔的儲存路徑
     * @param stirng $fileType		附檔的檔案格式
     * 
     * @return none
     */
    public function sendMail ($ary_addTo, $subject, $bodyInHTML, $ary_from, 
    $fileName = NULL, $filePath = NULL, $fileType = NULL)
    {
        $tr = new Zend_Mail_Transport_Sendmail('-f servicetp@amo.com.tw');
        Zend_Mail::setDefaultTransport($tr);
        $obj_mail = new Zend_Mail('utf-8');
        $obj_mail->addTo($ary_addTo['email'], $ary_addTo['nickName']);
        $obj_mail->setSubject("=?UTF-8?B?" . base64_encode($subject) . "?=");
        $obj_mail->setBodyHtml($bodyInHTML);
        $obj_mail->setFrom($ary_from['email'], $ary_from['nickName']);
        if (is_null($fileName) == FALSE || is_null($filePath) == FALSE ||
         is_null($fileType) == FALSE) {
            $binaryFileToAttach = file_get_contents($filePath . '/' . $fileName);
            $at = $obj_mail->createAttachment($binaryFileToAttach);
            $at->type = $fileType;
            $at->disposition = Zend_Mime::DISPOSITION_INLINE;
            $at->encoding = Zend_Mime::ENCODING_BASE64;
            $at->filename = $fileName;
        }
        $obj_mail->send();
         //    	return mail ( $ary_addTo['email'] , $subject , $bodyInHTML );
    }
    /**
     * 
     * 過濾html tag 和 取得字串
     * @param string $string
     * @param int $end
     */
    public static function filterSubContent ($string, $end = 40)
    {
        $str = "";
        $str = trim($string);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $str = str_replace("\n", " ", $str);
        $str = str_replace("\t", " ", $str);
        $str = str_replace("\r", " ", $str);
        $str = str_replace("\r\n", " ", $str);
        $str = trim($str);
        $strLen = mb_strlen($str, 'utf-8');
        $str = mb_substr($str, 0, $end, 'utf-8');
        if ($strLen > $end) {
            $str .= '...';
        }
        return $str;
    }
    /**
     * 
     * 電話區碼
     */
    public static function telAreaCode ()
    {
        $telArea = array('02', '03', '037', '04', '049', '05', '06', '07', '08', 
        '082', '0836', '089');
        return $telArea;
    }
    /**
     * 
     * 職業類別
     */
    public static function getJob ()
    {
        $telArea = array('農林漁牧職類', '採礦冶金職類', '軍公教職類', '經營管理職類', '專業人員職類', 
        '人事法務職類', '醫療護理職類', '財會金融職類', '業務銷售職類', '行政秘書職類', '技術服務職類', '電腦資訊職類', 
        '生產製造職類', '機械操作職類', '營建職類', '娛樂演藝職類', '傳播媒體職類', '電交通服務職類', '餐飲旅遊職類', 
        '保全警衛職類', '家事服務職類', '環境保護職類', '非技術服務職類');
        return $telArea;
    }
    /**
     * 
     * 國家 country
     */
    public static function countryArray ()
    {
        //        $country = array("--請選擇--", "台灣", "中國大陸", "美國", "其他");
        //		$country = array("--請選擇--", "台灣", "中國大陸", "美國", "其他");
        return $country;
    }
    /**
     * 
     * 城市array
     */
    public static function cityArray ()
    {
        //    	$city = array("--縣/市--", "臺北市", "基隆市", "新北市", "宜蘭縣", "新竹市", "新竹縣", "桃園縣", "苗栗縣", "臺中市", "彰化縣", "南投縣", "嘉義市", "嘉義縣", "雲林縣", "臺南市", "高雄市", "澎湖縣", "屏東縣", "臺東縣", "花蓮縣", "金門縣", "連江縣", "南海諸島");
        //		$city = array("--縣/市--", "台北市", "基隆市", "新北市", "宜蘭縣", "新竹市", "新竹縣", "桃園縣", "苗栗縣", "台中市", "彰化縣", "南投縣", "嘉義市", "嘉義縣", "雲林縣", "台南市", "高雄市", "澎湖縣", "屏東縣", "台東縣", "花蓮縣", "金門縣", "連江縣");
        //        $city = array(array('--請選擇--'), 
        //        array("台北市", "基隆市", "新北市", "宜蘭縣", "新竹市", "新竹縣", "桃園縣", "苗栗縣", "台中市", 
        //        "彰化縣", "南投縣", "嘉義市", "嘉義縣", "雲林縣", "台南市", "高雄市", "澎湖縣", "屏東縣", "台東縣", 
        //        "花蓮縣", "金門縣", "連江縣"), 
        //        array("河北省", "山西省", "內蒙古自治區", "遼寧省", "吉林省", "黑龍江省", "江蘇省", "浙江省", "安徽省", 
        //        "福建省", "江西省", "山東省", "河南省", "湖北省 ", "湖南省", "廣東省", "廣西壯族自治區", "海南省", 
        //        "四川省", "貴州省", "雲南省", "西藏自治區", "陝西省", "甘肅省", "青海省", "寧夏回族自治區", "新疆維吾爾自治區", 
        //        "長沙省", "廣州省", "南寧市", "海口市", "成都市", "貴陽市", "昆布市", "拉薩市", "西安市", "蘭州市", 
        //        "西寧市", "銀川市", "烏魯木齊市"), 
        //        array("Alabama/阿拉巴馬州", "Alaska/阿拉斯加州", "Arizona/亞利桑那州", "Arkansas/阿肯色州", 
        //        "California/加利福尼亞州", "Colorado/科羅拉多州", "Connecticut/康乃狄克州", 
        //        "Delaware/德拉瓦州", "Florida/佛羅里達州", "Georgia/喬治亞州", "Hawaii/夏威夷州", 
        //        "Idaho/愛達荷州", "Illinois/伊利諾州", "Indiana/印第安納州", "Iowa/愛荷華州", 
        //        "Kansas/堪薩斯州", "Kentucky/肯塔基州", "Louisiana/路易斯安那州", "Maine/緬因州", 
        //        "Maryland/馬里蘭州", "Massachusetts/麻薩諸塞州", "Michigan/密西根州", 
        //        "Minnesota/明尼蘇達州", "Mississippi/密西西比州", "Missouri/密蘇里州", "Montana/蒙大拿州", 
        //        "Nebraska/內布拉斯加州", "Nevada/內華達州", "New Hampshire/新罕布夏州", 
        //        "New Jersey/新澤西州", "New Mexico/新墨西哥州", "New York/紐約州", 
        //        "North Carolina/北卡羅來納州", "North Dakota/北達科他州", "Ohio/俄亥俄州", 
        //        "Oklahoma/奧克拉荷馬州	", "Oregon/奧勒岡州", "Pennsylvania/賓夕法尼亞州", 
        //        "Puerto Rico/波多黎各", "Rhode Island/羅德島州", "South Carolina/南卡羅來納州", 
        //        "South Dakota/南達科他州", "Tennessee/田納西州", "Texas/德克薩斯州", "Utah/猶他州", 
        //        "Vermont/佛蒙特州", "Virginia/維吉尼亞州", "Washington/華盛頓州", 
        //        "West Virginia/西維吉尼亞州", "Wisconsin/斯康辛州", "Wyoming/懷俄明州"));
        //        return $city;
        $city = array(
        "台北市", "基隆市", "新北市", "宜蘭縣", "新竹市", "新竹縣", "桃園縣", "苗栗縣", "台中市", "彰化縣", 
        "南投縣", "嘉義市", "嘉義縣", "雲林縣", "台南市", "高雄市", "澎湖縣", "屏東縣", "台東縣", "花蓮縣", 
        "金門縣", "連江縣");
        return $city;
    }
    /**
     * 
     * 區
     * @param unknown_type $num
     */
    public static function distArray ($num = 0)
    {
        //        $dist = array(array("--鄉鎮市區--"), array("--鄉鎮市區--", "中正區100",  "大同區103", "中山區104", "松山區105", "大安區106", 
        //        "萬華區108", "信義區110", "士林區111", "北投區112", "內湖區114", "南港區115", "文山區116"), 
        //        array("--鄉鎮市區--", "仁愛區200", "信義區201", "中正區202", "中山區203", "安樂區204", 
        //        "暖暖區205", "七堵區206"), 
        //        array("--鄉鎮市區--", "萬里區207", "金山區208", "板橋區220", "汐止區221", "深坑區222", 
        //        "石碇區223", "瑞芳區224", "平溪區226", "雙溪區227", "貢寮區228", "新店區231", "坪林區232", 
        //        "烏來區233", "永和區234", "中和區235", "土城區236", "三峽區237", "樹林區238", "鶯歌區239", 
        //        "三重區241", "新莊區242", "泰山區243", "林口區244", "蘆洲區247", "五股區248", "八里區249", 
        //        "淡水區251", "三芝區252", "石門區253"), 
        //        array("--鄉鎮市區--", "宜蘭市260", "頭城鎮261", "礁溪鄉262", "壯圍鄉263", "員山鄉264", 
        //        "羅東鎮265", "三星鄉266", "大同鄉267", "五結鄉268", "冬山鄉269", "蘇澳鎮270", "南澳鄉272", 
        //        "釣魚台列嶼290"), array("--鄉鎮市區--", "東區300", "北區300", "香山區300"), 
        //        array("--鄉鎮市區--", "竹北市302", "湖口鄉303", "新豐鄉304", "新埔鎮305", "關西鎮306", 
        //        "芎林鄉307", "寶山鄉308", "竹東鎮310", "五峰鄉311", "橫山鄉312", "尖石鄉313", "北埔鄉314", 
        //        "峨嵋鄉315"), 
        //        array("--鄉鎮市區--", "中壢市320", "平鎮市324", "龍潭鄉325", "楊梅鎮326", "新屋鄉327", 
        //        "觀音鄉328", "桃園市330", "龜山鄉333", "八德市334", "大溪鎮335", "復興鄉336", "大園鄉337", 
        //        "蘆竹鄉338"), 
        //        array("--鄉鎮市區--", "竹南鎮350", "頭份鎮351", "三灣鄉352", "南庄鄉353", "獅潭鄉354", 
        //        "後龍鎮356", "通霄鎮357", "苑裡鎮358", "苗栗市360", "造橋鄉361", "頭屋鄉362", "公館鄉363", 
        //        "大湖鄉364", "泰安鄉365", "銅鑼鄉366", "三義鄉367", "西湖鄉368", "卓蘭鎮369"), 
        //        array("--鄉鎮市區--", "中區400", "東區401", "南區402", "西區403", "北區404", "北屯區406", 
        //        "西屯區407", "南屯區408", "太平區411", "大里區412", "霧峰區413", "烏日區414", "豐原區420", 
        //        "后里區421", "石岡區422", "東勢區423", "和平區424", "新社區426", "潭子區427", "大雅區428", 
        //        "神岡區429", "大肚區432", "沙鹿區433", "龍井區434", "梧棲區435", "清水區436", "大甲區437", 
        //        "外埔區438", "大安區439"), 
        //        array("--鄉鎮市區--", "彰化市500", "芬園鄉502", "花壇鄉503", "秀水鄉504", "鹿港鎮505", 
        //        "福興鄉506", "線西鄉507", "和美鎮508", "伸港鄉509", "員林鎮510", "社頭鄉511", "永靖鄉512", 
        //        "埔心鄉513", "溪湖鎮514", "大村鄉515", "埔鹽鄉516", "田中鎮520", "北斗鎮521", "田尾鄉522", 
        //        "埤頭鄉523", "溪州鄉524", "竹塘鄉525", "二林鎮526", "大城鄉527", "芳苑鄉528", "二水鄉530"), 
        //        array("--鄉鎮市區--", "南投市540", "中寮鄉541", "草屯鎮542", "國姓鄉544", "埔里鎮545", 
        //        "仁愛鄉546", "名間鄉551", "集集鎮552", "水里鄉553", "魚池鄉555", "信義鄉556", "竹山鎮557", 
        //        "鹿谷鄉558"), array("--鄉鎮市區--", "嘉義市600"), 
        //        array("--鄉鎮市區--", "番路鄉602", "梅山鄉603", "竹崎鄉604", "阿里山605", "中埔鄉606", 
        //        "大埔鄉607", "水上鄉608", "鹿草鄉611", "太保市612", "朴子市613", "東石鄉614", "六腳鄉615", 
        //        "新港鄉616", "民雄鄉621", "大林鎮622", "溪口鄉623", "義竹鄉624", "布袋鎮625"), 
        //        array("--鄉鎮市區--", "斗南鎮630", "大埤鄉631", "虎尾鎮632", "土庫鎮633", "褒忠鄉634", 
        //        "東勢鄉635", "臺西鄉636", "崙背鄉637", "麥寮鄉638", "斗六市640", "林內鄉643", "古坑鄉646", 
        //        "莿桐鄉647", "西螺鎮648", "二崙鄉649", "北港鎮651", "水林鄉652", "口湖鄉653", "四湖鄉654", 
        //        "元長鄉655"), 
        //        array("--鄉鎮市區--", "中西區700", "東區701", "南區702", "北區704", "安平區708", 
        //        "安南區709", "永康區710", "歸仁區711", "新化區712", "左鎮區713", "玉井區714", "楠西區715", 
        //        "南化區716", "仁德區717", "關廟區718", "龍崎區719", "官田區720", "麻豆區721", "佳里區722", 
        //        "西港區723", "七股區724", "將軍區725", "學甲區726", "北門區727", "新營區730", "後壁區731", 
        //        "白河區732", "東山區733", "六甲區734", "下營區735", "柳營區736", "鹽水區737", "善化區741", 
        //        "大內區742", "山上區743", "新市區744", "安定區745"), 
        //        array("--鄉鎮市區--", "新興區800", "前金區801", "苓雅區802", "鹽埕區803", "鼓山區804", 
        //        "旗津區805", "前鎮區806", "三民區807", "楠梓區811", "小港區812", "左營區813", "仁武區814", 
        //        "大社區815", "岡山區820", "路竹區821", "阿蓮區822", "田寮區823", "燕巢區824", "橋頭區825", 
        //        "梓官區826", "彌陀區827", "永安區828", "湖內區829", "鳳山區830", "大寮區831", "林園區832", 
        //        "鳥松區833", "大樹區840", "旗山區842", "美濃區843", "六龜區844", "內門區845", "杉林區846", 
        //        "甲仙區847", "桃源區848", "那瑪夏區849", "茂林區851", "茄萣區852"), 
        //        array("--鄉鎮市區--", "馬公市880", "西嶼鄉881", "望安鄉882", "七美鄉883", "白沙鄉884", 
        //        "湖西鄉885"), 
        //        array("--鄉鎮市區--", "屏東市900", "三地門901", "霧臺鄉902", "瑪家鄉903", "九如鄉904", 
        //        "里港鄉905", "高樹鄉906", "鹽埔鄉907", "長治鄉908", "麟洛鄉909", "竹田鄉911", "內埔鄉912", 
        //        "萬丹鄉913", "潮州鎮920", "泰武鄉921", "來義鄉922", "萬巒鄉923", "崁頂鄉924", "新埤鄉925", 
        //        "南州鄉926", "林邊鄉927", "東港鎮928", "琉球鄉929", "佳冬鄉931", "新園鄉932", "枋寮鄉940", 
        //        "枋山鄉941", "春日鄉942", "獅子鄉943", "車城鄉944", "牡丹鄉945", "恆春鎮946", "滿州鄉947"), 
        //        array("--鄉鎮市區--", "臺東市950", "綠島鄉951", "蘭嶼鄉952", "延平鄉953", "卑南鄉954", 
        //        "鹿野鄉955", "關山鎮956", "海端鄉957", "池上鄉958", "東河鄉959", "成功鎮961", "長濱鄉962", 
        //        "太麻里鄉963", "金峰鄉964", "大武鄉965", "達仁鄉966"), 
        //        array("--鄉鎮市區--", "花蓮市970", "新城鄉971", "秀林鄉972", "吉安鄉973", "壽豐鄉974", 
        //        "鳳林鎮975", "光復鄉976", "豐濱鄉977", "瑞穗鄉978", "萬榮鄉979", "玉里鎮981", "卓溪鄉982", 
        //        "富里鄉983"), 
        //        array("--鄉鎮市區--", "金沙鎮890", "金湖鎮891", "金寧鄉892", "金城鎮893", "烈嶼鄉894", 
        //        "烏坵鄉896"), array("--鄉鎮市區--", "南竿鄉209", "北竿鄉210", "莒光鄉211", "東引212"), 
        //        array("--鄉鎮市區--", "東沙817", "南沙819"));
        //        return $dist[$num];
        //        1
        $dist = array(
        array("中正區100", "大同區103", "中山區104", "松山區105", "大安區106", "萬華區108", 
        "信義區110", "士林區111", "北投區112", "內湖區114", "南港區115", "文山區116"), 
        array("仁愛區200", "信義區201", "中正區202", "中山區203", "安樂區204", "暖暖區205", 
        "七堵區206"), 
        array("萬里區207", "金山區208", "板橋區220", "汐止區221", "深坑區222", "石碇區223", 
        "瑞芳區224", "平溪區226", "雙溪區227", "貢寮區228", "新店區231", "坪林區232", "烏來區233", 
        "永和區234", "中和區235", "土城區236", "三峽區237", "樹林區238", "鶯歌區239", "三重區241", 
        "新莊區242", "泰山區243", "林口區244", "蘆洲區247", "五股區248", "八里區249", "淡水區251", 
        "三芝區252", "石門區253"), 
        array("宜蘭市260", "頭城鎮261", "礁溪鄉262", "壯圍鄉263", "員山鄉264", "羅東鎮265", 
        "三星鄉266", "大同鄉267", "五結鄉268", "冬山鄉269", "蘇澳鎮270", "南澳鄉272", "釣魚台列嶼290"), 
        array("東區300", "北區300", "香山區300"), 
        array("竹北市302", "湖口鄉303", "新豐鄉304", "新埔鎮305", "關西鎮306", "芎林鄉307", 
        "寶山鄉308", "竹東鎮310", "五峰鄉311", "橫山鄉312", "尖石鄉313", "北埔鄉314", "峨嵋鄉315"), 
        array("中壢市320", "平鎮市324", "龍潭鄉325", "楊梅鎮326", "新屋鄉327", "觀音鄉328", 
        "桃園市330", "龜山鄉333", "八德市334", "大溪鎮335", "復興鄉336", "大園鄉337", "蘆竹鄉338"), 
        array("竹南鎮350", "頭份鎮351", "三灣鄉352", "南庄鄉353", "獅潭鄉354", "後龍鎮356", 
        "通霄鎮357", "苑裡鎮358", "苗栗市360", "造橋鄉361", "頭屋鄉362", "公館鄉363", "大湖鄉364", 
        "泰安鄉365", "銅鑼鄉366", "三義鄉367", "西湖鄉368", "卓蘭鎮369"), 
        array("中區400", "東區401", "南區402", "西區403", "北區404", "北屯區406", "西屯區407", 
        "南屯區408", "太平區411", "大里區412", "霧峰區413", "烏日區414", "豐原區420", "后里區421", 
        "石岡區422", "東勢區423", "和平區424", "新社區426", "潭子區427", "大雅區428", "神岡區429", 
        "大肚區432", "沙鹿區433", "龍井區434", "梧棲區435", "清水區436", "大甲區437", "外埔區438", 
        "大安區439"), 
        array("彰化市500", "芬園鄉502", "花壇鄉503", "秀水鄉504", "鹿港鎮505", "福興鄉506", 
        "線西鄉507", "和美鎮508", "伸港鄉509", "員林鎮510", "社頭鄉511", "永靖鄉512", "埔心鄉513", 
        "溪湖鎮514", "大村鄉515", "埔鹽鄉516", "田中鎮520", "北斗鎮521", "田尾鄉522", "埤頭鄉523", 
        "溪州鄉524", "竹塘鄉525", "二林鎮526", "大城鄉527", "芳苑鄉528", "二水鄉530"), 
        array("南投市540", "中寮鄉541", "草屯鎮542", "國姓鄉544", "埔里鎮545", "仁愛鄉546", 
        "名間鄉551", "集集鎮552", "水里鄉553", "魚池鄉555", "信義鄉556", "竹山鎮557", "鹿谷鄉558"), 
        array("嘉義市600"), 
        array("番路鄉602", "梅山鄉603", "竹崎鄉604", "阿里山605", "中埔鄉606", "大埔鄉607", 
        "水上鄉608", "鹿草鄉611", "太保市612", "朴子市613", "東石鄉614", "六腳鄉615", "新港鄉616", 
        "民雄鄉621", "大林鎮622", "溪口鄉623", "義竹鄉624", "布袋鎮625"), 
        array("斗南鎮630", "大埤鄉631", "虎尾鎮632", "土庫鎮633", "褒忠鄉634", "東勢鄉635", 
        "臺西鄉636", "崙背鄉637", "麥寮鄉638", "斗六市640", "林內鄉643", "古坑鄉646", "莿桐鄉647", 
        "西螺鎮648", "二崙鄉649", "北港鎮651", "水林鄉652", "口湖鄉653", "四湖鄉654", "元長鄉655"), 
        array("中西區700", "東區701", "南區702", "北區704", "安平區708", "安南區709", "永康區710", 
        "歸仁區711", "新化區712", "左鎮區713", "玉井區714", "楠西區715", "南化區716", "仁德區717", 
        "關廟區718", "龍崎區719", "官田區720", "麻豆區721", "佳里區722", "西港區723", "七股區724", 
        "將軍區725", "學甲區726", "北門區727", "新營區730", "後壁區731", "白河區732", "東山區733", 
        "六甲區734", "下營區735", "柳營區736", "鹽水區737", "善化區741", "大內區742", "山上區743", 
        "新市區744", "安定區745"), 
        array("新興區800", "前金區801", "苓雅區802", "鹽埕區803", "鼓山區804", "旗津區805", 
        "前鎮區806", "三民區807", "楠梓區811", "小港區812", "左營區813", "仁武區814", "大社區815", 
        "岡山區820", "路竹區821", "阿蓮區822", "田寮區823", "燕巢區824", "橋頭區825", "梓官區826", 
        "彌陀區827", "永安區828", "湖內區829", "鳳山區830", "大寮區831", "林園區832", "鳥松區833", 
        "大樹區840", "旗山區842", "美濃區843", "六龜區844", "內門區845", "杉林區846", "甲仙區847", 
        "桃源區848", "那瑪夏區849", "茂林區851", "茄萣區852"), 
        array("馬公市880", "西嶼鄉881", "望安鄉882", "七美鄉883", "白沙鄉884", "湖西鄉885"), 
        array("屏東市900", "三地門901", "霧臺鄉902", "瑪家鄉903", "九如鄉904", "里港鄉905", 
        "高樹鄉906", "鹽埔鄉907", "長治鄉908", "麟洛鄉909", "竹田鄉911", "內埔鄉912", "萬丹鄉913", 
        "潮州鎮920", "泰武鄉921", "來義鄉922", "萬巒鄉923", "崁頂鄉924", "新埤鄉925", "南州鄉926", 
        "林邊鄉927", "東港鎮928", "琉球鄉929", "佳冬鄉931", "新園鄉932", "枋寮鄉940", "枋山鄉941", 
        "春日鄉942", "獅子鄉943", "車城鄉944", "牡丹鄉945", "恆春鎮946", "滿州鄉947"), 
        array("臺東市950", "綠島鄉951", "蘭嶼鄉952", "延平鄉953", "卑南鄉954", "鹿野鄉955", 
        "關山鎮956", "海端鄉957", "池上鄉958", "東河鄉959", "成功鎮961", "長濱鄉962", "太麻里鄉963", 
        "金峰鄉964", "大武鄉965", "達仁鄉966"), 
        array("花蓮市970", "新城鄉971", "秀林鄉972", "吉安鄉973", "壽豐鄉974", "鳳林鎮975", 
        "光復鄉976", "豐濱鄉977", "瑞穗鄉978", "萬榮鄉979", "玉里鎮981", "卓溪鄉982", "富里鄉983"), 
        array("金沙鎮890", "金湖鎮891", "金寧鄉892", "金城鎮893", "烈嶼鄉894", "烏坵鄉896"), 
        array("南竿鄉209", "北竿鄉210", "莒光鄉211", "東引212"), array("東沙817", "南沙819"));
        return $dist[$num];
    }
    public static function getSelectArray ($data)
    {
        $dataArray = array();
        foreach ($data as $value) {
            $dataArray[$value] = $value;
        }
        return $dataArray;
    }
    public static function payMethod ($method)
    {
        $text = '';
        switch ($method) {
            case 1:
                $text = 'ATM';
                break;
            case 2:
                $text = '銀行匯款';
                break;
            case 3:
                $text = '到店付款';
                break;
            case 4:
                $text = '貨到收現';
                break;
            case 5:
                $text = '線上刷卡';
                break;
        }
        return $text;
    }
    public static function orderStatus ($status)
    {
        $text = '';
        switch ($status) {
            case 1:
                $text = '未入帳';
                break;
            case 2:
                $text = '已入帳';
                break;
            case 3:
                $text = '已取消';
                break;
            case 4:
                $text = '已出貨';
                break;
            case 5:
                $text = '待處理';
                break;
            case 6:
                $text = '已處理';
                break;
        }
        return $text;
    }
    /**
     * 
     * 檔案上傳檢查
     * @param array $input
     * path 路徑
     */
    public function upload ($input,$size = null, $imgArr = null)
    {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $fileinfo = $adapter->getFileInfo();
    	if(!isset($imgArr)){
			$imgArr = array('jpg','jpeg','png','gif','bmp');
		}
        $isImg = false;
        $isZip = false;
        $isNOing = false;
        $isTrue = false;
        foreach ($fileinfo as $index => $file) {

        	if($file['name'] == ''){
        		$isNOing = true;		
        	}else{
        		$isTrue = true;
        	}
        }
        if($isNOing && !$isTrue){
        	$rs['success'] = true;        	
        	return $rs;
        }else if($isNOing && $isTrue){
        	$rs['success'] = false;
        	$rs['msg'] = '請上傳圖檔格式';
        	return $rs;
        }	
        if (count($fileinfo) >= 1) { #多文件上传
            foreach ($fileinfo as $index => $file) {
            	
                if (isset($input['m_path'][$index])) {
                    $filePath = $input['m_path'][$index];
                } else {
                    $filePath = $input['path'];
                }
                //check dir
                if (! is_dir($filePath)) {
                    mkdir($filePath, 0755);
                }
                if ($file['name'] != '') {
                    $t_filename = explode('.', $file['name']);
                    $t_filename = strtolower(end($t_filename));
                    if (in_array($t_filename, $imgArr)) {
                        $isImg = true;
                    }elseif ('zip' == $t_filename) {
                        $isZip = true;
                    }
                }
            }
            //是圖片
            if ($isImg) {
                $rs = $this->imageUpload($input,$size);
            } elseif ($isZip) {
                $rs = $this->zipUpload($input);
            } else {
                $rs['success'] = false;
                $rs['msg'] = '請上傳圖檔格式';
            }
        } else {
            $rs['success'] = false;
        }
        return $rs;
    }
    /**
     * 
     * 圖片上傳
     * @param array $input
     */
    public function imageUpload ($input,$size=null)
    {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $fileinfo = $adapter->getFileInfo();
        $isUpload = false;
        if (count($fileinfo) >= 1) {
            $files = array();
            foreach ($fileinfo as $index => $file) {
                if (isset($input['m_path'][$index])) {
                    $filePath = $input['m_path'][$index];
                } else {
                    $filePath = $input['path'];
                }
                $adapter->setDestination($filePath);
                //change fileName
                $fileName = $this->checkFileName($filePath, $file['name']);
                //rename
                $adapter->addFilter('Rename', array('source' => $file['tmp_name'], 'target' => $filePath . '/' . $fileName, 'overwrite' => true));
                
                $img_size = (isset($size))?$size:200000;
                $kb = ceil($img_size/1024);
                if ($file['size'] < $img_size ) {
                    $isUpload = true;
                    if ($adapter->receive($index)) {
                        $isUpload = true;
                        $files[$index] = $fileName;
                    } else {
                        //可以不輸入也可以新增
                        $isUpload = true;
                    }
                } else {
                    $isUpload = false;
                    $rs['msg'] = '請選擇'.$kb.'kb以下的圖檔上傳';
                }
            }
            $rs['success'] = $isUpload;
            $rs['files'] = $files;
        } else {
            $rs['success'] = $isUpload;
        }
        return $rs;
    }
    /**
     * 
     * 是zip檔案上傳
     * @param array input
     */
    public function zipUpload ($input, $imgArr = null)
    {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $filePath = $input['path'];
        $adapter->setDestination($filePath);
        $file = $adapter->getFileInfo();
        if ($adapter->receive()) {
            require_once ('pclzip.lib.php');
            $fileinfo = array_values($file);
            $archive = new PclZip($filePath . '/' . $fileinfo[0]['name']);
            //解壓縮
            $list = $archive->extract(PCLZIP_OPT_PATH, 
            $filePath . "/photo");
            //            chmod($filePath . '/photo', 0777);
            $names = array();
            $success = $faild = 0;
            foreach ($list as $index => $img) {
                chmod($img['filename'], 0777);
                $fileName = $img['stored_filename'];
                //檢查是否為img
                $t_filename = explode('.', $img['filename']);
                $t_filename = strtolower(end($t_filename));
                $imgArr = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
                $tempFile = explode('/', $img['filename']);
                if (in_array($t_filename, $imgArr) &&
                 ! in_array('__MACOSX', $tempFile)) {
                    //				if ($imageFilter->isValid($img['filename'])){
                    //判斷filename是不是被資料夾包著，如果array >1 表示有被包，就從新給filename
                    if (count($tempFile) >
                     1) {
                        $fileName = $tempFile[count($tempFile) - 1];
                    }
                    $success += 1;
                    $isHave = false;
                    $files = scandir($filePath);
                    foreach ($files as $filename) {
                        if ($filename == $fileName) {
                            $isHave = true;
                            break;
                        }
                    }
                    if ($isHave) {
                        $nameData = explode('.', $fileName);
                        $t_nameData = explode('_', $nameData[0]);
                        $num = 1;
                        $newName = '';
                        while (true) {
                            $newName = $t_nameData[0] . '_' . $num . '.' .
                             $nameData[1];
                            if (! in_array($newName, $files)) {
                                break;
                            }
                            //	   	 			if ($num >= 5000){
                            //	   	 				return false;
                            //	   	 			}
                            $num ++;
                        }
                        $fileName = $newName;
                        array_push($names, $fileName);
                        copy($img['filename'], $filePath . '/' . $fileName);
                        unlink($img['filename']);
                    } else {
                        array_push($names, $fileName);
                        copy($img['filename'], $filePath . '/' . $fileName);
                        unlink($img['filename']);
                    }
                } else {
                    $faild += 1;
                    //刪除不是資料夾的檔案
                    if ($img['folder'] == false) {
                        unlink($img['filename']);
                    }
                }
            }
            //刪除zip
            unlink($filePath . '/' . $fileinfo[0]['name']);
            $this->_delTree($filePath . "/photo");
            $rs['success'] = TRUE;
            $rs['files'] = $names;
            $rs['msg'] = '成功新增：' . $success . '張圖片，沒有新增檔案數：' . $faild;
            $rs['type'] = 'zip';
        } else {
            $messages = $adapter->getMessages();
            $rs['success'] = FALSE;
            $rs['msg'] = implode("\n", $messages);
        }
        return $rs;
    }
    /**
     * 
     * 檢查檔案名稱
     * @param string $filePath
     * @param string $name
     */
    public function checkFileName ($filePath, $name)
    {
        $fileName = $name;
        $isHave = false;
        $files = scandir($filePath);
        foreach ($files as $filename) {
            if ($filename == $fileName) {
                $isHave = true;
                break;
            }
        }
        if ($isHave) {
            $nameData = explode('.', $fileName);
            $t_nameData = explode('_', $nameData[0]);
            $num = 1;
            $newName = '';
            while (true) {
                $newName = $t_nameData[0] . '_' . $num . '.' . $nameData[1];
                if (! in_array($newName, $files)) {
                    break;
                }
                //	   	 		if ($num >= 5000){
                //	   	 			return false;
                //	   	 		}
                $num ++;
            }
            $fileName = $newName;
        }
        return $fileName;
    }
    //刪除資料夾
    function removedir ($dir, $o_dir)
    {
        if ($dir != $o_dir) {
            if ($handle = opendir($dir)) {
                while (false !== ($item = readdir($handle))) {
                    //不是. 或 ..才做
                    if ($item != "." && $item != "..") {
                        if (is_dir($dir . "/" . $item)) {
                            //看是否還有其他資料夾
                            $folders = scandir(
                            $dir . "/" . $item);
                            if (count($folders) > 2) {
                                //re do
                                $this->removedir(
                                $dir . "/" . $item, $o_dir);
                            } else {
                                rmdir($dir . "/" . $item);
                                $num = strrpos($dir, "/");
                                //re do
                                $this->removedir(
                                substr($dir, 0, $num), $o_dir);
                            }
                        } else {
                            //	                    unlink($dir."/".$item); 
                        }
                    }
                }
            }
        }
    }
    private function _delTree ($dir)
    {
        $files = glob($dir . '/*', GLOB_MARK);
        foreach ($files as $file) {
            if (substr($file, - 1) == '/')
                $this->_delTree($file);
            else
                unlink($file);
        }
        if (is_dir($dir))
            rmdir($dir);
    }
    public function checkUploadType ()
    {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $fileinfo = $adapter->getFileInfo();
        foreach ($fileinfo as $file) {
            $t_filename = explode('.', $file['name']);
            $t_filename = strtolower(end($t_filename));
        }
        return $t_filename;
    }
}