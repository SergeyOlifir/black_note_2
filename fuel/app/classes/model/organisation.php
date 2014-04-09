<?php

class Model_Organisation extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'organisation_type' => array(
                    'data_type' => 'int',
                    'ladel' => 'organisation_type',
                    'validation' => array('required')
                ),
		'sfera_type' => array(
                    'data_type' => 'int',
                    'ladel' => 'sfera_type',
                    'validation' => array('required')
                ),
		'country_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'country_id',
                    'validation' => array('required')
                ),
		'region_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'region_id',
                    'validation' => array('required')
                ),
		'sity_id' => array(
                    'data_type' => 'int',
                    'ladel' => 'sity_id',
                    'validation' => array('required')
                ),
		'title' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'title',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'user_id',
		'adress' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'adress',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'phone' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'phone',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'ovner' => array(
                    'data_type' => 'varchar',
                    'ladel' => 'ovner',
                    'validation' => array('required', 'min_length' => array(3), 'max_length' => array(50))
                ),
		'logo',
                'status',
                'raiting',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
        
        protected static $_belongs_to = array(
            'country' => array(
                'key_from' => 'country_id',
                'model_to' => 'Model_Country',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'region' => array(
                'key_from' => 'region_id',
                'model_to' => 'Model_Region',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            'city' => array(
                'key_from' => 'sity_id',
                'model_to' => 'Model_Sity',
                'key_to' => 'id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
        protected static $_has_many = array(
            'filials' => array(
                'key_from' => 'id',
                'model_to' => 'Model_Filial',
                'key_to' => 'organisation_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            ),
            
            'posts' => array(
                'key_from' => 'id',
                'model_to' => 'Model_Post',
                'key_to' => 'organisation_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
	protected static $_table_name = 'organisations';
        
        public static $organisation_types = array(
            '0' => array(
                    'title' => 'Организация или частное лицо',
                    'id' => '0'
                ),
            '1' => array(
                    'title' => 'Государственное учреждение',
                    'id' => '1'
                )
        );
        
        public function unmoderated_filials() {
            return Model_Filial::query()
                    ->where('organisation_id', $this->id)
                    ->where('status', 1)
                    ->get();
        }


        public static $organisation_sferes_types = array(
            '0' => array(
                '0' => array(
                    'title' => 'Автомобили',
                    'id' => '0'
                ),
                '1' => array(
                    'title' => 'Банки, страхование, финансы',
                    'id' => '1'
                ),
                '3' => array(
                    'title' => 'Бытовые услуги',
                    'id' => '3'
                ),
                '4' => array(
                    'title' => 'Организация питания',
                    'id' => '4'
                ),
                '5' => array(
                    'title' => 'Поставки электроэнергии, газа',
                    'id' => '5'
                ),
                '6' => array(
                    'title' => 'Водоснабжение, канализация, обращения с отходами',
                    'id' => '6'
                ),
                '7' => array(
                    'title' => 'Экология',
                    'id' => '7'
                ),
                '8' => array(
                    'title' => 'Здравоохранение',
                    'id' => '8'
                ),
                '9' => array(
                    'title' => 'Компьютеры, программы',
                    'id' => '9'
                ),
                '10' => array(
                    'title' => 'Культура, искусство, религия',
                    'id' => '10'
                ),
                '11' => array(
                    'title' => 'Медицина, фармацевтика',
                    'id' => '11'
                ),
                '12' => array(
                    'title' => 'Научная и техническая деятельность',
                    'id' => '12'
                ),
                '13' => array(
                    'title' => 'Образование и наука',
                    'id' => '13'
                ),
                '14' => array(
                    'title' => 'Оптовая и розничная торговля',
                    'id' => '14'
                ),
                '15' => array(
                    'title' => 'Одежда, обувь, подарки',
                    'id' => '15'
                ),
                '16' => array(
                    'title' => 'Органы государственной власти',
                    'id' => '16'
                ),
                '17' => array(
                    'title' => 'Охрана и безопасность',
                    'id' => '17'
                ),
                '18' => array(
                    'title' => 'Складское хозяйство',
                    'id' => '18'
                ),
                '19' => array(
                    'title' => 'Почтовая и курьерская деятельность',
                    'id' => '19'
                ),
                '20' => array(
                    'title' => 'Политические и общественные организации',
                    'id' => '20'
                ),
                '21' => array(
                    'title' => 'Посольства, представительства',
                    'id' => '21'
                ),
                '22' => array(
                    'title' => 'Право, юридические услуги',
                    'id' => '22'
                ),
                '23' => array(
                    'title' => 'Предоставление социальной помощи',
                    'id' => '23'
                ),
                '24' => array(
                    'title' => 'Промышленность',
                    'id' => '24'
                ),
                '25' => array(
                    'title' => 'Ремонт автотранспортных средств и мотоциклов',
                    'id' => '25'
                ),
                '26' => array(
                    'title' => 'Связь, телекоммуникации',
                    'id' => '26'
                ),
                '27' => array(
                    'title' => 'Сельское хозяйство, ветеринария',
                    'id' => '27'
                ),
                '28' => array(
                    'title' => 'СМИ, издательство, реклама',
                    'id' => '28'
                ),
                '29' => array(
                    'title' => 'Спорт, красота',
                    'id' => '29'
                ),
                '30' => array(
                    'title' => 'Строительство, недвижимость',
                    'id' => '30'
                ),
                '31' => array(
                    'title' => 'Товары для дома',
                    'id' => '31'
                ),
                '32' => array(
                    'title' => 'Транспорт, логистика',
                    'id' => '32'
                ),
                '33' => array(
                    'title' => 'Туризм, путешествия',
                    'id' => '33'
                ),
                '34' => array(
                    'title' => 'Временное размещение (квартиры, гостиницы…)',
                    'id' => '34'
                ),
                '35' => array(
                    'title' => 'Услуги и товары для бизнеса',
                    'id' => '35'
                ),
                '36' => array(
                    'title' => 'Энергетика, полезные ископаемые',
                    'id' => '36'
                ),
                '37' => array(
                    'title' => 'Лесное хозяйство и рыбное хозяйство',
                    'id' => '37'
                ),
                '38' => array(
                    'title' => 'Добывающая промышленность и разработка карьеров',
                    'id' => '38'
                ),
                '39' => array(
                    'title' => 'Перерабатывающая промышленность',
                    'id' => '39'
                ),
                '40' => array(
                    'title' => 'Деятельность в сфере административного обслуживания',
                    'id' => '40'
                ),
                '41' => array(
                    'title' => 'Государственное управление',
                    'id' => '41'
                ),
                '42' => array(
                    'title' => 'Оборона',
                    'id' => '42'
                ),
                '43' => array(
                    'title' => 'Социальное страхование',
                    'id' => '43'
                ),
                '44' => array(
                    'title' => 'Образование',
                    'id' => '44'
                ),
                '45' => array(
                    'title' => 'Искусство, спорт, развлечения и отдых',
                    'id' => '45'
                ),
                '46' => array(
                    'title' => 'Деятельность домашних хозяйств',
                    'id' => '46'
                ),
                '47' => array(
                    'title' => 'Частная деятельность',
                    'id' => '47'
                ),
                '48' => array(
                    'title' => 'Предоставление других видов услуг',
                    'id' => '48'
                ),
                '49' => array(
                    'title' => 'Предоставление других видов товаров',
                    'id' => '49'
                ),
                
                
            ),
            
            '1' => array(
                '0' => array(
                    'title' => 'Автомобили',
                    'id' => '0'
                ),
                '1' => array(
                    'title' => 'Банки, страхование, финансы',
                    'id' => '1'
                ),
                '3' => array(
                    'title' => 'Бытовые услуги',
                    'id' => '3'
                ),
                '4' => array(
                    'title' => 'Организация питания',
                    'id' => '4'
                ),
                '5' => array(
                    'title' => 'Поставки электроэнергии, газа',
                    'id' => '5'
                ),
                '6' => array(
                    'title' => 'Водоснабжение, канализация, обращения с отходами',
                    'id' => '6'
                ),
                '7' => array(
                    'title' => 'Экология',
                    'id' => '7'
                ),
                '8' => array(
                    'title' => 'Здравоохранение',
                    'id' => '8'
                ),
                '9' => array(
                    'title' => 'Компьютеры, программы',
                    'id' => '9'
                ),
                '10' => array(
                    'title' => 'Культура, искусство, религия',
                    'id' => '10'
                ),
                '11' => array(
                    'title' => 'Медицина, фармацевтика',
                    'id' => '11'
                ),
                '12' => array(
                    'title' => 'Научная и техническая деятельность',
                    'id' => '12'
                ),
                '13' => array(
                    'title' => 'Образование и наука',
                    'id' => '13'
                ),
                '14' => array(
                    'title' => 'Оптовая и розничная торговля',
                    'id' => '14'
                ),
                '15' => array(
                    'title' => 'Одежда, обувь, подарки',
                    'id' => '15'
                ),
                '16' => array(
                    'title' => 'Органы государственной власти',
                    'id' => '16'
                ),
                '17' => array(
                    'title' => 'Охрана и безопасность',
                    'id' => '17'
                ),
                '18' => array(
                    'title' => 'Складское хозяйство',
                    'id' => '18'
                ),
                '19' => array(
                    'title' => 'Почтовая и курьерская деятельность',
                    'id' => '19'
                ),
                '20' => array(
                    'title' => 'Политические и общественные организации',
                    'id' => '20'
                ),
                '21' => array(
                    'title' => 'Посольства, представительства',
                    'id' => '21'
                ),
                '22' => array(
                    'title' => 'Право, юридические услуги',
                    'id' => '22'
                ),
                '23' => array(
                    'title' => 'Предоставление социальной помощи',
                    'id' => '23'
                ),
                '24' => array(
                    'title' => 'Промышленность',
                    'id' => '24'
                ),
                '25' => array(
                    'title' => 'Ремонт автотранспортных средств и мотоциклов',
                    'id' => '25'
                ),
                '26' => array(
                    'title' => 'Связь, телекоммуникации',
                    'id' => '26'
                ),
                '27' => array(
                    'title' => 'Сельское хозяйство, ветеринария',
                    'id' => '27'
                ),
                '28' => array(
                    'title' => 'СМИ, издательство, реклама',
                    'id' => '28'
                ),
                '29' => array(
                    'title' => 'Спорт, красота',
                    'id' => '29'
                ),
                '30' => array(
                    'title' => 'Строительство, недвижимость',
                    'id' => '30'
                ),
                '31' => array(
                    'title' => 'Товары для дома',
                    'id' => '31'
                ),
                '32' => array(
                    'title' => 'Транспорт, логистика',
                    'id' => '32'
                ),
                '33' => array(
                    'title' => 'Туризм, путешествия',
                    'id' => '33'
                ),
                '34' => array(
                    'title' => 'Временное размещение (квартиры, гостиницы…)',
                    'id' => '34'
                ),
                '35' => array(
                    'title' => 'Услуги и товары для бизнеса',
                    'id' => '35'
                ),
                '36' => array(
                    'title' => 'Энергетика, полезные ископаемые',
                    'id' => '36'
                ),
                '37' => array(
                    'title' => 'Лесное хозяйство и рыбное хозяйство',
                    'id' => '37'
                ),
                '38' => array(
                    'title' => 'Добывающая промышленность и разработка карьеров',
                    'id' => '38'
                ),
                '39' => array(
                    'title' => 'Перерабатывающая промышленность',
                    'id' => '39'
                ),
                '40' => array(
                    'title' => 'Деятельность в сфере административного обслуживания',
                    'id' => '40'
                ),
                '41' => array(
                    'title' => 'Государственное управление',
                    'id' => '41'
                ),
                '42' => array(
                    'title' => 'Оборона',
                    'id' => '42'
                ),
                '43' => array(
                    'title' => 'Социальное страхование',
                    'id' => '43'
                ),
                '44' => array(
                    'title' => 'Образование',
                    'id' => '44'
                ),
                '45' => array(
                    'title' => 'Искусство, спорт, развлечения и отдых',
                    'id' => '45'
                ),
                '46' => array(
                    'title' => 'Деятельность домашних хозяйств',
                    'id' => '46'
                ),
                '47' => array(
                    'title' => 'Частная деятельность',
                    'id' => '47'
                ),
                '48' => array(
                    'title' => 'Предоставление других видов услуг',
                    'id' => '48'
                ),
                '49' => array(
                    'title' => 'Предоставление других видов товаров',
                    'id' => '49'
                ),
            )
        );
        
        public static $organisation_status = array(
            1 => 'Ожидает Модерации',
            0 => 'Не принятая',
            2 => 'Принятая'
        );

}
