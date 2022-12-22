<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT

   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  class ht_google_icon_chrome
  {
    public string $code;
    public $group;
    public $title;
    public $description;
    public ?int $sort_order = 0;
    public bool $enabled = false;

    public function __construct()
    {
      $this->code = get_class($this);
      $this->group = basename(__DIR__);
      $this->title = CLICSHOPPING::getDef('module_header_tags_icon_chrome_title');
      $this->description = CLICSHOPPING::getDef('module_header_tags_icon_chrome_description');

      if (\defined('MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_STATUS')) {
        $this->sort_order = MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_STATUS == 'True');
      }
    }

    public function execute()
    {
      $CLICSHOPPING_Template = Registry::get('Template');

      $CLICSHOPPING_Template->addBlock('<link rel="icon" sizes="192x192" href="' . $CLICSHOPPING_Template->getDirectoryTemplateImages() . MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_LINK . '">' . "\n", $this->group);
    }

    public function isEnabled()
    {
      return $this->enabled;
    }

    public function check()
    {
      return \defined('MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_STATUS');
    }

    public function install()
    {
      $CLICSHOPPING_Db = Registry::get('Db');

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Do you want activate this module ?',
          'configuration_key' => 'MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_STATUS',
          'configuration_value' => 'True',
          'configuration_description' => 'Do you want activate this module ?',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Please insert the relative link to find the icon',
          'configuration_key' => 'MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_LINK',
          'configuration_value' => 'logos/others/logo_clicshopping_192.webp',
          'configuration_description' => 'Insert the relative link to find the icon 192x192',
          'configuration_group_id' => '6',
          'sort_order' => '21',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );


      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Sort order',
          'configuration_key' => 'MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_SORT_ORDER',
          'configuration_value' => '50',
          'configuration_description' => 'Sort order (the loest is diplayed in first)',
          'configuration_group_id' => '6',
          'sort_order' => '25',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );
    }

    public function remove()
    {
      return Registry::get('Db')->exec('delete from :table_configuration where configuration_key in ("' . implode('", "', $this->keys()) . '")');
    }

    public function keys()
    {
      return ['MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_STATUS',
        'MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_LINK',
        'MODULE_HEADER_TAGS_GOOGLE_ICON_CHROME_SORT_ORDER'
      ];
    }
  }

