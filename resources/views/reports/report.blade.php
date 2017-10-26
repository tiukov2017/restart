<input type="hidden" id="field-reminder">ֿֿ

<nav class="navbar navbar-default navbar-fixed-top" id="report-nav">
    <div class="container-fluid no-padding">

    </div>
    <div class="container no-padding">
        <div class="row">
        <!--Navbar Right Side-->
        <div class="col-sm-2">
            <div class="logo">
                <img src="{{asset('assets/images/checknet-logo.png')}}" class="img-responsive" alt="צ'קנט לוגו">
            </div>
        </div>
        <!--Navbar left Side-->
        <div class="col-sm-10 col-xs-12 no-padding">
            <ul class="navigation no-padding nav">
                <li class="single_page">
                    <a href="#section_1" class="report-nav-link">

                            <img src="{{asset('assets/images/face_icon.png')}}" height="34" width="34"
                                 alt="אייקון פרצוף">
                            <p>פרטים אישיים</p>
                    </a></li>
                <li class="single_page">
                    <a href="#section_2" class="report-nav-link">

                        <img src="{{asset('assets/images/conversation_icon.png')}}" alt="אייקון דו שיח">
                        <p>אזכורים ברשת</p>

                    </a>
                </li>
                <li class="single_page">
                    <a href="#section_3" class="report-nav-link">
                        <img src="{{asset('assets/images/money_icon.png')}}" height="34" width="34" alt="אייקון שטרות">

                        <p>מידע פיננסי</p>

                    </a>
                </li>
                <li class="single_page">
                    <a href="#section_4" class="report-nav-link">
                            <img src="{{asset('assets/images/legal_icon.png')}}" alt="אייקון מידע משפטי">

                            <p>מידע משפטי</p>
                    </a>
                </li>
                <li class="single_page">
                    <a href="#section_5" class="report-nav-link">
                            <img src="{{asset('assets/images/assets_icon.png')}}" alt="אייקון נכסים">
                            <p>מידע כלכלי</p>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</nav>
<div class="messages-container view-mode-invisible row"></div>
@include('fields.reminder_alert',['message'=>'שים לב,ישנם קונטיינרים אותם סימנת כלא מוכנים'])
<div class="container" id="reportApp">
    <input type="hidden" value="true">
    <div class="save-menu view-mode-invisible" id="save-menu" >

        <div class="floating-action-button floating-menu-item">
            <i class="fa fa fa-bars" aria-hidden="true"></i>
        </div>

    </div>
        <div class="row strech">
            <div class="col-xs-2 sidebar">
                <div class="sidebar_container">
                    <div class="profile_picture">
                        <img src="{{asset('assets/images/profile.png')}}" class="replaceAbleImage img-circle img-responsive" alt="תמונת משתמש">
                        <p data-field="full-name">{{$object_fullname}}</p>
                    </div>
                    <div class="social_profiles">
                        <a href="#" class="replaceAbleLink" target="_blank">
                            <img src="{{asset('assets/images/facebook_icon.png')}}" alt="פייסבוק אייקון">
                        </a>
                        <a href="#" class="replaceAbleLink" target="_blank">
                            <img src="{{asset('assets/images/linkedin_icon.png')}}" alt="לינקדין אייקון">
                        </a>
                    </div>
                    <div class="map_key">
                        <div class="row strech">
                            <div class="col-xs-12 no-padding">
                                <section class="header">מקרא סמלים</section>
                                <section class="main">
                                    <div class="symbol row">
                                        <div class="col-xs-12">
                                            <img src="{{asset('/assets/images/more_info_map_key.png')}}" alt="אייקון מידע נוסף">
                                            מידע כללי מורחב
                                        </div>
                                       </div>
                                    <div class="symbol row">
                                        <div class="col-xs-12">
                                            <img src="{{asset('assets/images/all_clear_map_key.png')}}" alt="אייקון לא אותרה בעיה">
                                            לא אותרה בעיה כלשהי
                                        </div>
                                      </div>
                                    <div class="symbol row">
                                        <div class="col-xs-12">
                                            <img src="{{asset('assets/images/pay-attention_map_key.png')}}" alt="אייקון שים לב">
                                            מידע שכדאי לשים לב אליו
                                        </div>
                                      </div>
                                    <div class="symbol row">
                                        <div class="col-xs-12">
                                            <img src="{{asset('assets/images/details_not_found_map_key.png')}}" alt="אייקון לא נמצאו נתונים">
                                            לא נמצאו נתונים קשורים בחיפוש
                                        </div>
                                      </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-xs-12">

                <form class="form-horizontal">

                    <h2 class="report-subheader">
                        <img src="{{asset('assets/images/media_icon.png')}}" />
                        מדיה
                    </h2>
                    @include('report_blocks.personal_details.section',['title' => 'פרטים אישיים', 'icon' => asset('assets/images/face_icon.png'), 'id'=>1,
                    'desc'=>'ריכוז הנתונים על <span data-field="full-name">'.$object_fullname.'</span> כפי שעלה מסגרת הכנת הדוח'])

                    @include('report_blocks.net_menetions.section',['title' => 'אזכורים מהרשת', 'icon' => asset('assets/images/conversation_icon.png'), 'id'=>2,
                    'desc'=>'<span>החלק כולל אזכורים בכתבות ופרסומים בעיתונות הארצית,המקומית ופנים ארגונית,בפורומים ,בלוגים וקבוצות דיון.באתרים מקצועיים וייעודיים לתחומי עיסוק,עניין ופנאי(ציבורי\חברתי\פוליטי\ספורטיבי),תמצית הפרופיל האישי\מקצועי ברשתות חברתיות כמו פייסבוק,לינקדאין ואחרות.</span>'])

                    <h2 class="report-subheader">
                        <img src="{{asset('assets/images/data-pool-extended.png')}}" />
                        מאגרי מידע מורחב
                    </h2>

                    @include('report_blocks.consumer_credit.section',['title' => 'מידע פיננסי', 'icon' => asset('assets/images/money_icon.png'), 'id'=>3,
                    'desc'=>'<div>מידע המותר לפרסום על פי חוק נתוני אשראי וכולל 7 בדיקות שונות :'.
                    '<ul>'.
                    '<li>דיווחים של תאגיד בנקאי או חברת אשראי על התראות שיקים חוזרים או הליכים לגביית חוב.</li>'.
                    '<li>חשבונות בנק מוגבלים שהוגדרו כמוגבלים החל מתאריך 01\08\04 (על פי חוק נתוני אשראי).</li>'.
                     '<li>צווים בלשכת ההוצאה לפועל או התראות על חייב מוגבל באמצעים.</li>'.
                     '<li>נתונים מכונס הנכסים הרשמי אודות הליכי פשיטת רגל וכינוס נכסים.</li>'.
                     '<li>צווים והגבלות שניתנו ע"י בית משפט על בעלי מניות ונושאי משרות.</li>'.
                     '<li>דיווחים של גופים מסחריים למאגרי מידע ייעודיים ןמורשים על חובות של לקוחותיהם.</li>'.
                     '<li>מידע חיובי הנובע לעמידה בתנאי הלוואות ו\או מסגרות אשראי שניתנו מתאגידים בנקאיים וחברות אשראי.</li>'.
                    '</ul></div>'])

                    @include('report_blocks.legal_data.section',['title' => 'מידע משפטי', 'icon' => asset('assets/images/legal_icon.png'), 'id'=>4,
                    'desc'=>'<ul>'.
                    '<li>הליכים םלילייפ ואזרחיים-נתונים על תיקים בבתי משפט הכוללים החלטות ופסקי דין הקשורים באופן מובהק ל<span data-field="full-name">'.$object_fullname.'</span>.</li>'.
                    '<li>הליכים אזרחיים מחוץ לכותלי בית משפט-הליכים המתקיימים ברשויות מקומיות\אזוריות.</li>'.
                    '<li>מסמכים משפטיים ממקורות וגורמים רשמיים דוגמת רשימות הפרסומים ,מסמכי רשויות וכדומה.</li></ul>'])

                    @include('report_blocks.finance_data.section',['title' => 'מידע כלכלי', 'icon' => asset('assets/images/assets_icon.png'), 'id'=>5,
                    'desc'=>'<ul>'.
                    '<li>פרטים על נכס בכתובת המגורים כפי שקיים במרשמי רשות מקרקעי ישראל ובטאבו.</li>'.
                    '<li>מימון\הלוואות ,הנכסים שהעמיד כערבון ,שותפים בנכסים,ערבים בעסקה,נותן המימון (בנתונחם כוללים שעבודים ומשכונים שנרשמו החל משנת 1995).</li>'.
                    '<li>ריכוז כתובות הקודמות של <span data-field="full-name">'.$object_fullname.'</span> שנמצאו במהלך הכנת הדוח.</li>'.
                    '<li>בעלות\זכויות על נכסים אחרים-כולל חיפוש במאגרי המידע בנושאי פטנטים,סימנים מסחריים,זכויות יוצרים וקניין רוחני.</li>'.
                    '<li>תמצית קשר של נשוא הדוח ובן\בת זוג לעסקים וחברות - בדיקה על רישום כעצמאי או בעל תיק במע"מ ןמס הכנסה,הקשר\נתונים על חברות הקשורות אליהם כמנהלים ,דירקטורים או בעלי מניות.</li>'.
                    '</ul>'])
                    @include('report_blocks.hidden_data.hidden_data_block')

                </form>
                 @include('report_blocks.modals.file_promt_popup',['id'=>'upload-popup','title'=>'בחר קובץ או כתובת לתמונה','acceptAction'=>'save-file-btn','cancelAction'=>'cancel-btn'])
                @include('report_blocks.modals.before_publish_popup',['id'=>'publish_popup','title'=>'תזכורת','acceptAction'=>'publishReport','attributes'=>'data-target='.route('publishReport'),'cancelAction'=>'show-reminders','message'=>'נותרו קונטיינרים מסומנים אשר לא מילאת ,האם להמשיך?'])
            </div>
        </div>
    </div>
