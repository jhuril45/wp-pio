<?php
function getRecentPosts(){
  $data = get_posts( array( 
    'post_type' => 'post',
    'posts_per_page' => 5,
    )
  );
  $recent_posts = [];
  foreach ($data as $key => $value) {
    $post_thumbnail_id = get_post_thumbnail_id($value->ID);
    if ( $post_thumbnail_id ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
      $recent_src = wp_get_attachment_url( $post_thumbnail_id, 'full');
      $value->fimg_url = $recent_src;
    }else{
      $value->fimg_url = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
    }
    array_push($recent_posts,$value);
  }
  return $recent_posts;
}

function register_rest_images(){
  register_rest_field( array('post'),
      'fimg_url',
      array(
        'get_callback'    => 'get_rest_featured_image',
        'update_callback' => null,
        'schema'          => null,
      )
  );
}
add_action('rest_api_init', 'register_rest_images' );

function get_rest_featured_image( $object, $field_name, $request ) {
  if( $object['featured_media'] ){
      $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
      return $img[0];
  }
  return false;
}

function check_news_category() {
	$is_term = term_exists('News');
  wp_create_category('News');
}
add_action( 'admin_init', 'check_news_category' );

function custom_get_custom_logo(){
  $logo = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $logo , 'full' );
  return $image[0];
}

function custom_get_post_data(){
  $post_id = url_to_postid(get_permalink());
  // $data = get_post($post_id);
  return $post_id;
}

function custom_get_user_role(){
  return wp_get_current_user()->roles[0];
}

function add_tab_query_var( $vars ){
  $vars[] = "tab";
  return $vars;
}

function add_id_query_var( $vars ){
  $vars[] = "id";
  return $vars;
}

function add_office_query_var( $vars ){
  $vars[] = "office";
  return $vars;
}

add_filter( 'query_vars', 'add_tab_query_var' );
add_filter( 'query_vars', 'add_id_query_var' );
add_filter( 'query_vars', 'add_office_query_var' );

function myInit() {
  global $globalUrl;
  $globalUrl = url_to_postid(get_permalink());
}
add_action('init', 'myInit');

function getCarouselImages() {
  global $wpdb;
  $results = $wpdb->get_results("SELECT * FROM wp_carousel_images");
  return $results;
}

function getHeaderMenus() {
  $arr = [
    array(
      "title" => "Home",
      "url" => get_home_url()."",
      "slug" => "",
      "is_menu" => false,
    ),
    array(
      "title" => "About Butuan",
      "url" => get_home_url()."/about",
      "slug" => "about",
      "is_menu" => false,
    ),
    array(
      "title" => "Government",
      "url" => get_home_url()."",
      "slug" => "government",
      "is_menu" => true,
      "sub_menu" => [
        array(
          "title" => "City Officials",
          "url" => get_home_url()."/city-officials",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
        array(
          "title" => "City Offices",
          "url" => get_home_url()."/offices",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
        array(
          "title" => "City Issuances",
          "url" => get_home_url()."/offices",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
        array(
          "title" => "City Barangays",
          "url" => get_home_url()."/barangays",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
      ]
    ),
    array(
      "title" => "Tourism",
      "url" => get_home_url()."/tourism",
      "slug" => "tourism",
      "is_menu" => false,
    ),
    array(
      "title" => "Business",
      "url" => get_home_url()."",
      "slug" => "business",
      "is_menu" => false,
    )
  ];

  return $arr;
}

function getOfficeList() {
  global $wpdb;
  $table_name = $wpdb->prefix . "offices";
  $offices = $wpdb->get_results("SELECT * FROM $table_name");
  return $offices;

  $arr = [
    array(
      'title' => 'CITY MAYOR',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. RONNIE VICENTE C. LAGNADA, CE',
      'assistant' => '',
    ),
  ];
  return $arr;
}

function getOffice($office) {
  global $wpdb;
  $table_name = $wpdb->prefix . "offices";
  $office = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $office");
  return $office;
  return array(
    'title' => 'Public Information Office',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscit elit.',
    'logo' => get_template_directory_uri().'/assets/images/PIO.png',
    'facebook' => 'https://www.facebook.com/butuancitypioofficial',
    'twitter' => 'https://www.facebook.com/butuancitypioofficial',
    'messenger' => 'https://www.facebook.com/butuancitypioofficial',
  );
}



function getCityBarangay(){
  $arr = [
    array(
      'title' => 'AGAO',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. EDNA C. GUERERO',
    ),
    array(
      'title' => 'DATU SILONGAN',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. ALAIN JAMES G. BOQUE',
    ),
    array(
      'title' => 'DIEGO SILANG',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. BONIFACIO L. TORREDES JR.',
    ),
    array(
      'title' => 'HUMABON',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. FLORENCE G. SADIASA',
    ),
    array(
      'title' => 'LEON KILAT',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. JESUS C. GEMIDA',
    ),
    array(
      'title' => 'SAN IGNACIO',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. JOCELYN E. AMADO',
    ),
    array(
      'title' => 'SIKATUNA',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. NORBERTO A. HERNANDEZ JR.',
    ),
    array(
      'title' => 'RAJAH SOLIMAN',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. JANX C. AVERGONZADO',
    ),
    array(
      'title' => 'URDUJA',
      'url' => get_home_url().'/offices/?office=pio',
      'slug' => 'offices-pio',
      'is_menu' => false,
      'head' => 'HON. MARIO A. TIU',
    ),
  ];
  return $arr;
}

function getCityOfficials(){
  return array(
    'mayor' => array(
      'name' => 'HON. RONNIE VICENTE C. LAGNADA',
      'position' => 'City Mayor',
      'image' => get_template_directory_uri().'/assets/images/RCL.webp',
    ),
    'vice_mayor' => array(
      'name' => 'HON. JOSE S. AQUINO II',
      'position' => 'City Vice Mayor',
      'image' => get_template_directory_uri().'/assets/images/JS. Aquino.jpg',
    ),
    'sp_members' => [
      array(
        'name' => 'HON. GLENN C. CARAMPATANA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/1 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Education, Culture, Arts, and Heritage',
              'Committee on Rules and Styles',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Health',
              'Committee on People’s Council and Sectoral Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Civil Service and Reorganization',
              'Committee on Family, Women, and Children’s Welfare',
              'Committee on Good Government and Ethics',
              'Committee on Science and Technology Development',
              'Committee on Ways and Means',
              'Committee on Youth and Sports Development',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. FERDINAND E. NALCOT',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/2 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Labor, Employment, and Human Resources Development',
              'Committee on Social Welfare and Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Barangay Development',
              'Committee on Disaster Risk Reduction and Climate Change Adaptation',
              'Committee on Economic, Trade, and Industry Development',
              'Committee on Health',
              'Committee on Infrastructure Development',
              'Committee on Rules and Styles',
              'Committee on Ways and Means',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. DERRICK A. PLAZA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/3 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Accounts',
              'Committee on Civil Service and Reorganization',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Education, Culture, Arts, and Heritage',
              'Committee on Health',
              'Committee on Infrastructure Development',
              'Committee on People’s Council and Sectoral Development',
              'Committee on Public Order and Safety',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. CROMWELL P. NORTEGA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/4 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on People’s Council and Sectoral Development',
              'Committee on Tourism Development',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Youth and Sports Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Appropriations',
              'Committee on Environment and Natural Resources Development',
              'Committee on Infrastructure Development',
              'Committee on Public Order and Safety',
              'Committee on Urban Planning, Housing, and Resettlement',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. REMA E. BURDEOS',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/5 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Family, Women, and Children’s Welfare',
              'Committee on Good Government and Ethics',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Franchises and Licenses',
              'Committee on Rules and Styles',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Barangay Development',
              'Committee on Civil Service and Reorganization',
              'Committee on Economic, Trade, and Industry Development',
              'Committee on Education, Culture, Arts, and Heritage',
              'Committee on Labor, Employment, and Human Resources Development',
              'Committee on Social Welfare and Development',
              'Committee on Tourism Development',
              'Committee on Ways and Means',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. EHRNEST JOHN C. SANCHEZ',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/6 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Public Order and Safety',
              'Committee on Urban Planning, Housing, and Resettlement',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Disaster Risk Reduction and Climate Change Adaptation',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Economic, Trade, and Industry Development',
              'Committee on Franchises and Licenses',
              'Committee on Good Government and Ethics',
              'Committee on Rules and Styles',
              'Committee on Youth and Sports Development',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. JOHN GIL S. UNAY, SR.',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/7 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Ways and Means',
              'Committee on Franchises and Licenses',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Civil Service and Reorganization',
              'Committee on Environment and Natural Resources Development',
              'Committee on Good Government and Ethics',
              'Committee on Infrastructure Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Accounts',
              'Committee on Labor, Employment, and Human Resources Development',
              'Committee on Public Order and Safety',
              'Committee on Rules and Styles',
              'Committee on Urban Planning, Housing, and Resettlement',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. JOSEPH OMAR O. ANDAYA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/8 - Hon. Andaya.jpg',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Economic, Trade, and Industry Development',
              'Committee on Environment and Natural Resources Development',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Accounts',
              'Committee on Appropriations',
              'Committee on Labor, Employment, and Human Resources Development',
              'Committee on Science and Technology Development',
              'Committee on Ways and Means',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Franchises and Licenses',
              'Committee on People’s Council and Sectoral Development',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. CHERRY MAY G. BUSA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/9 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Health',
              'Committee on Science and Technology Development',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Economic, Trade, and Industry Development',
              'Committee on Education, Culture, Arts, and Heritage',
              'Committee on Social Welfare and Development',
              'Committee on Tourism Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Accounts',
              'Committee on Appropriations',
              'Committee on Civil Service and Reorganization',
              'Committee on Environment and Natural Resources Development',
              'Committee on Family, Women, and Children’s Welfare',
              'Committee on Labor, Employment, and Human Resources Development',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. VINCENT RIZAL C. ROSARIO',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/10 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Disaster Risk Reduction and Climate Change Adaptation',
              'Committee on Infrastructure Development',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Barangay Development',
              'Committee on Public Order and Safety',
              'Committee on Urban Planning, Housing, and Resettlement',
              'Committee on Tourism Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Appropriations',
              'Committee on Environment and Natural Resources Development',
              'Committee on Franchises and Licenses',
              'Committee on Science and Technology Development',
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. GEMMA P. TABADA',
        'position' => 'SP Member',
        'image' => get_template_directory_uri().'/assets/images/11 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Barangay Development',
            ]
          ),
          array(
            'title' => 'Vice Chairman',
            'list' => [
              'Committee on Family, Women, and Children’s Welfare',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Accounts',
              'Committee on Disaster Risk Reduction and Climate Change Adaptation',
              'Committee on Good Government and Ethics',
              'Committee on People’s Council and Sectoral Development',
              'Committee on Social Welfare and Development',
              'Committee on Tourism Development',
              'Committee on Urban Planning, Housing, and Resettlement',
              'Committee on Youth and Sports Development'
            ]
          ),
        ]
      ),
      array(
        'name' => 'HON. WEN KOK L. CHIANG II',
        'position' => 'SP Member, President SK Federation',
        'image' => get_template_directory_uri().'/assets/images/12 - Hon.webp',
        'positions' => [
          array(
            'title' => 'Chairman',
            'list' => [
              'Committee on Youth and Sports Development',
            ]
          ),
          array(
            'title' => 'Member',
            'list' => [
              'Committee on Barangay Development',
              'Committee on Disaster Risk Reduction and Climate Change Adaptation',
              'Committee on Education, Culture, Arts, and Heritage',
              'Committee on Family, Women, and Children’s Welfare',
              'Committee on Health',
              'Committee on Science and Technology Development',
              'Committee on Social Welfare and Development',
              'Committee on Tourism Development'
            ]
          ),
        ]
      ),
    ],
    'committees' => [
      array(
        'title' => 'COMMITTEE ON APPROPRIATIONS',
        'chairman' => 'Hon. Jose S. Aquino II',
        'vice_chairman' => 'Hon. Joseph Omar O. Andaya',
        'members' => [
          'Hon. Cherry May G. Busa',
          'Hon. Cromwell P. Nortega',
          'Hon. Vincent Rizal C. Rosario',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON ACCOUNTS',
        'chairman' => 'Hon. Derrick A. Plaza',
        'vice_chairman' => 'Hon. Joseph Omar O. Andaya',
        'members' => [
          'Hon. Cherry May G. Busa',
          'Hon. John Gil S. Unay, Sr.',
          'Hon. Gemma P. Tabada',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON BARANGAY DEVELOPMENT',
        'chairman' => 'Hon. Gemma P. Tabada',
        'vice_chairman' => 'Hon. Vincent Rizal C. Rosario',
        'members' => [
          'Hon. Wen Kok L. Chiang II',
          'Hon. Rema E. Burdeos',
          'Hon. Ferdinand E. Nalcot',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON CIVIL SERVICE AND REORGANIZATION',
        'chairman' => 'Hon. Derrick A. Plaza',
        'vice_chairman' => 'Hon. John Gil S. Unay, Sr.',
        'members' => [
          'Hon. Cherry May G. Busa',
          'Hon. Rema E. Burdeos',
          'Hon. Glenn C. Carampatana',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON DISASTER RISK REDUCTION AND CLIMATE CHANGE ADAPTATION',
        'chairman' => 'Hon. Vincent Rizal C. Rosario',
        'vice_chairman' => 'Hon. Ehrnest John C. Sanchez',
        'members' => [
          'Hon. Ferdinand E. Nalcot',
          'Hon. Gemma P. Tabada',
          'Hon. Wen Kok L. Chiang II',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON ECONOMIC, TRADE, AND INDUSTRY DEVELOPMENT',
        'chairman' => 'Hon. Joseph Omar O. Andaya',
        'vice_chairman' => 'Hon. Cherry May G. Busa',
        'members' => [
          'Hon. Rema E. Burdeos',
          'Hon. Ferdinand E. Nalcot',
          'Hon. Ehrnest John C. Sanchez',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON EDUCATION, CULTURE, ARTS, AND HERITAGE',
        'chairman' => 'Hon. Glenn C. Carampatana',
        'vice_chairman' => 'Hon. Cherry May G. Busa',
        'members' => [
          'Hon. Rema E. Burdeos',
          'Hon. Wen Kok L. Chiang II',
          'Hon. Derrick A. Plaza',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON ENVIRONMENT AND NATURAL RESOURCES DEVELOPMENT',
        'chairman' => 'Hon. Joseph Omar O. Andaya',
        'vice_chairman' => 'Hon. John Gil S. Unay, Sr.',
        'members' => [
          'Hon. Cromwell P. Nortega',
          'Hon. Cherry May G. Busa',
          'Hon. Vincent Rizal C. Rosario',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON FAMILY, WOMEN, AND CHILDREN’S WELFARE',
        'chairman' => 'Hon. Rema E. Burdeos',
        'vice_chairman' => 'Hon. Gemma P. Tabada',
        'members' => [
          'Hon. Cherry May G. Busa',
          'Hon. Glenn C. Carampatana',
          'Hon. Wen Kok L. Chiang II',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON FRANCHISES AND LICENSES',
        'chairman' => 'Hon. John Gil S. Unay, Sr.',
        'vice_chairman' => 'Hon. Rema E. Burdeos',
        'members' => [
          'Hon. Ehrnest John C. Sanchez',
          'Hon. Joseph Omar O. Andaya',
          'Hon. Vincent Rizal C. Rosario',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON GOOD GOVERNMENT AND ETHICS',
        'chairman' => 'Hon. Rema E. Burdeos',
        'vice_chairman' => 'Hon. John Gil S. Unay, Sr.',
        'members' => [
          'Hon. Ehrnest John C. Sanchez',
          'Hon. Gemma P. Tabada',
          'Hon. Glenn C. Carampatana',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON HEALTH',
        'chairman' => 'Hon. Cherry May G. Busa',
        'vice_chairman' => 'Hon. Glenn C. Carampatana',
        'members' => [
          'Hon. Ferdinand E. Nalcot',
          'Hon. Wen Kok L. Chiang II',
          'Hon. Derrick A. Plaza',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON INFRASTRUCTURE DEVELOPMENT',
        'chairman' => 'Hon. Vincent Rizal C. Rosario',
        'vice_chairman' => 'Hon. John Gil S. Unay, Sr.',
        'members' => [
          'Hon. Cromwell P. Nortega',
          'Hon. Derrick A. Plaza',
          'Hon. Ferdinand E. Nalcot',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON LABOR, EMPLOYMENT, AND HUMAN RESOURCES DEVELOPMENT',
        'chairman' => 'Hon. Ferdinand E. Nalcot',
        'vice_chairman' => 'Hon. Joseph Omar O. Andaya',
        'members' => [
          'Hon. Rema E. Burdeos',
          'Hon. Cherry May G. Busa',
          'Hon. John Gil S. Unay, Sr.',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON PEOPLE’S COUNCIL AND SECTORAL DEVELOPMENT',
        'chairman' => 'Hon. Cromwell P. Nortega',
        'vice_chairman' => 'Hon. Glenn C. Carampatana',
        'members' => [
          'Hon. Derrick A. Plaza',
          'Hon. Gemma P. Tabada',
          'Hon. Joseph Omar O. Andaya',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON PUBLIC ORDER AND SAFETY',
        'chairman' => 'Hon.Ehrnest John C. Sanchez',
        'vice_chairman' => 'Hon. Vincent Rizal C. Rosario',
        'members' => [
          'Hon. John Gil S. Unay, Sr.',
          'Hon. Cromwell P. Nortega',
          'Hon. Derrick A. Plaza',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON RULES AND STYLES',
        'chairman' => 'Hon. Glenn C. Carampatana',
        'vice_chairman' => 'Hon. Rema E. Burdeos',
        'members' => [
          'Hon. Ferdinand E. Nalcot',
          'Hon. Ehrnest John C. Sanchez',
          'Hon. John Gil S. Unay, Sr.',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON SCIENCE AND TECHNOLOGY DEVELOPMENT',
        'chairman' => 'Hon. Cherry May G. Busa',
        'vice_chairman' => 'Hon. Joseph Omar O. Andaya',
        'members' => [
          'Hon. Vincent Rizal C. Rosario',
          'Hon. Wen Kok L. Chiang II',
          'Hon. Glenn C. Carampatana',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON SOCIAL WELFARE AND DEVELOPMENT',
        'chairman' => 'Hon. Ferdinand E. Nalcot',
        'vice_chairman' => 'Hon. Cherry May G. Busa',
        'members' => [
          'Hon. Gemma P. Tabada',
          'Hon. Wen Kok L. Chiang II',
          'Hon. Rema E. Burdeos',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON TOURISM DEVELOPMENT',
        'chairman' => 'Hon. Cromwell P. Nortega',
        'vice_chairman' => 'Hon. Cherry May G. Busa',
        'members' => [
          'Hon. Rema E. Burdeos',
          'Hon. Wen Kok L. Chiang II',
          'Hon. Gemma P. Tabada',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON URBAN PLANNING, HOUSING, AND RESETTLEMENT',
        'chairman' => 'Hon. Ehrnest John C. Sanchez',
        'vice_chairman' => 'Hon. Vincent Rizal C. Rosario',
        'members' => [
          'Hon. Cromwell P. Nortega',
          'Hon. Gemma P. Tabada',
          'Hon. John Gil S. Unay, Sr.',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON WAYS AND MEANS',
        'chairman' => 'Hon. John Gil S. Unay, Sr.',
        'vice_chairman' => 'Hon. Joseph Omar O. Andaya',
        'members' => [
          'Hon. Glenn C. Carampatana',
          'Hon. Rema E. Burdeos',
          'Hon. Ferdinand E. Nalcot',
        ]
      ),
      array(
        'title' => 'COMMITTEE ON YOUTH & SPORTS DEVELOPMENT',
        'chairman' => 'Hon. Wen Kok L. Chiang II',
        'vice_chairman' => 'Hon. Cromwell P. Nortega',
        'members' => [
          'Hon. Ehrnest John C. Sanchez',
          'Hon. Gemma P. Tabada',
          'Hon. Glenn C. Carampatana',
        ]
      ),
    ]
  );
}

function getFlipCards() {
  $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,';
  $arr = [
    array(
      'icon' => 'agriculture',
      'image' => 'agriculture.jpg',
      'class_front' => 'bg-green-5 text-white',
      'class_back' => 'bg-green-8 text-white',
      'title' => 'Agriculture',
      'description' => $lorem,
    ),
    array(
      'icon' => 'warning',
      'image' => 'disaster.jpg',
      'class_front' => 'bg-light-blue-6 text-white',
      'class_back' => 'bg-light-blue-8 text-white',
      'title' => 'Disaster Risk Reduction',
      'description' => $lorem,
    ),
    array(
      'icon' => 'school',
      'image' => 'school.jpg',
      'class_front' => 'bg-purple-4 text-white',
      'class_back' => 'bg-purple-7 text-white',
      'title' => 'Education',
      'description' => $lorem,
    ),
    array(
      'icon' => 'health_and_safety',
      'image' => 'health.jpg',
      'class_front' => 'bg-light-green-6 text-white',
      'class_back' => 'bg-light-green-8 text-white',
      'title' => 'Health',
      'description' => $lorem,
    ),
    array(
      'icon' => 'apartment',
      'image' => 'infrastracture.jpg',
      'class_front' => 'bg-deep-orange-6 text-white',
      'class_back' => 'bg-deep-orange-8 text-white',
      'title' => 'Infrastracture Development',
      'description' => $lorem,
    ),
    array(
      'icon' => 'beach_access',
      'image' => 'tourism.jpg',
      'class_front' => 'bg-yellow-6 text-white',
      'class_back' => 'bg-yellow-8 text-white',
      'title' => 'Tourism',
      'description' => $lorem,
    ),
    array(
      'icon' => 'traffic',
      'image' => 'traffic.jpg',
      'class_front' => 'bg-cyan-6 text-white',
      'class_back' => 'bg-cyan-8 text-white',
      'title' => 'Transportation and Traffic Management',
      'description' => $lorem,
    ),
    array(
      'icon' => 'recycling',
      'image' => 'recycle.jpg',
      'class_front' => 'bg-green-6 text-white',
      'class_back' => 'bg-green-8 text-white',
      'title' => 'Solid Waste Management',
      'description' => $lorem,
    ),
  ];
  
  return $arr;
}

function get_posted_date() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf(
    $time_string,
    esc_attr( get_the_date( DATE_W3C ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( DATE_W3C ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    /* translators: %s: post date. */
    esc_html_x( '%s', 'post date', 'pio' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

// add_action('wp', 'redirect_private_page_to_login');

function redirect_private_page_to_login(){

    global $wp_query;

    $queried_object = get_queried_object();

    if ($queried_object->post_status == "private" && !is_user_logged_in()) {
      wp_redirect(home_url('/login'));
    } 
}

function restrict_admin() {
  $user = wp_get_current_user();
  if($user->roles[0] != 'administrator'){
    return wp_redirect(home_url('/dashboard'));
  }
}
add_action( 'admin_init', 'restrict_admin', 1 );

function my_login_logo() { ?>
  <style type="text/css">
      #login h1 a, .login h1 a {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Butuan_Logo_Transparent.png);
        height:150px;
        width:150px;
        background-size: 150px 150px;
        background-repeat: no-repeat;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );