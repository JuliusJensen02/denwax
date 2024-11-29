<?php
add_shortcode('custom-language-switcher', 'languageSwitcher');
function languageSwitcher() {
	$lang = apply_filters( 'wpml_current_language', NULL );
    $languages = apply_filters( 'wpml_active_languages', NULL );
    unset($languages[$lang]);
	ob_start();
	?>
    <style>
        .languageSwitcherHeader{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .currentLang{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
            padding: 0;
            font-family: "Raleway", Sans-Serif;
            font-weight: 400;
            text-align: center;
            font-size: 12px;
            gap: 3px;
        }
        .langList{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            margin: 0;
            padding: 10px 0 0;
            max-height: 0;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 100%);
            overflow: hidden;
            transition: ease-in-out max-height 0.3s;
        }
        .languageSwitcherHeader:hover .langList{
            max-height: 100px;
        }
        .languageSwitcherHeader a{
            border-radius: 50%;
            width: 38px;
            height: 38px;
            overflow: hidden;
            background-color: #ECE6DF;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .languageSwitcherHeader a img{
            border-radius: 50%;
            width: 25px;
            height: 25px;
            object-fit: cover;
        }
        @media (max-width: 1024px){
            .languageSwitcherHeader .currentLang>div{
                display: none;
            }
        }
    </style>
	<div class="languageSwitcherHeader">
        <div class="currentLang">
            <?php
            if($lang == 'da'){
                echo insertLangDaNoLink()."<div>Sprog</div>";
            }else if($lang == 'en'){
                echo insertLangEnNoLink()."<div>Languages</div>";
            }else if($lang == 'de'){
                echo insertLangDeNoLink()."<div>Sprache</div>";
            }
            ?>
        </div>
        <div class="langList">
            <?php
            foreach($languages as $language){
                if($language['language_code'] == 'da'){
                    echo insertLangDa();
                }else if($language['language_code'] == 'en'){
                    echo insertLangEn();
                }else if($language['language_code'] == 'de'){
                    echo insertLangDe();
                }
            }
            ?>
        </div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


function insertLangDa(){
    return'
    <a href="'.apply_filters( 'wpml_permalink', get_the_permalink(get_the_ID()), 'da' ).'">
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/da.svg" alt="Danish" width="38" height="38">
    </a>
    ';
}
function insertLangDaNoLink(){
	return'
    <a>
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/da.svg" alt="Danish" width="38" height="38">
    </a>
    ';
}
function insertLangEn(){
	return'
    <a href="'.apply_filters( 'wpml_permalink', get_the_permalink(get_the_ID()), 'en' ).'">
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.svg" alt="English" width="38" height="38">
    </a>
    ';
}
function insertLangEnNoLink(){
	return'
    <a>
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.svg" alt="English" width="38" height="38">
    </a>
    ';
}
function insertLangDe(){
	return'
    <a href="'.apply_filters( 'wpml_permalink', get_the_permalink(get_the_ID()), 'de' ).'">
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/de.svg" alt="German" width="38" height="38">
    </a>
    ';
}
function insertLangDeNoLink(){
	return'
    <a>
        <img src="https://denwax.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/de.svg" alt="German" width="38" height="38">
    </a>
    ';
}
?>
