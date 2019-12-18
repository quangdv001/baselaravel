<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Services\GeneralInfoService;
use App\Services\SettingFooterService;
use Illuminate\Support\Str;

class Footer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(GeneralInfoService $generalInfoService, SettingFooterService $settingFooterService)
    {
        //
        $info = $generalInfoService->get([]);
        $footer = $settingFooterService->get([])->load('info', 'page')->toArray();
        $listSocial = $generalInfoService->get(['conditions'=>[['key'=>'type','value'=>GeneralInfoService::TYPE_SOCIAL]]]);
        foreach ($footer as $k=> $item){
            if($item['type']==SettingFooterService::TYPE_SOCIAL){
                $idSocial = json_decode($item['social_id']);
                $arrSocial = [];
                if(!empty($idSocial)&&!empty($listSocial)){
                    foreach ($listSocial as $itemSocial){
                        if(in_array((string)($itemSocial->id),$idSocial)){
                            $arrSocial[]= $itemSocial;
                        }
                    }

                }
                $footer[$k]['social']= $arrSocial;
            }
        }
        $dataInfo = [
            'logo' => '',
            'name' => '',
            'address' => '',
            'certificate_text' => '',
            'certificate_image' => '',
            'certificate_number' => '',
            'phone' => '',
            'email' => '',
        ];
        foreach ($info as $item) {
            switch ($item->type) {
                case GeneralInfoService::TYPE_LOGO:
                    $dataInfo['logo'] = $item->img;
                    break;
                case GeneralInfoService::TYPE_NAME:
                    $dataInfo['name'] = $item->content;
                    break;
                case GeneralInfoService::TYPE_ADDRESS:
                    $dataInfo['address'] = $item->content;
                    break;
                case GeneralInfoService::TYPE_CERTIFICATE_TEXT:
                    $dataInfo['certificate_text'] = $item->content;
                    break;
                case GeneralInfoService::TYPE_CERTIFICATE_IMAGE:
                    $dataInfo['certificate_image'] = $item->img;
                    break;
                case GeneralInfoService::TYPE_CERTIFICATE_NUMBER:
                    $dataInfo['certificate_number'] = $item->content;
                    break;
                case GeneralInfoService::TYPE_PHONE_MAIN:
                    $dataInfo['phone'] = $item->content;
                    break;
                case GeneralInfoService::TYPE_EMAIL_MAIN:
                    $dataInfo['email'] = $item->content;
                    break;
            }
        }

        $dataFooter = [];
        $this->convertData($footer, 0, $dataFooter);

        return view('widgets.footer', [
            'config' => $this->config,
            'footer' => $footer,
            'dataInfo' => $dataInfo,
            'dataFooter' => $dataFooter,
        ]);
    }

    private function convertData($data, $parent_id = 0, &$res = [])
    {
        foreach ($data as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $res[$item['id']] = $item;
                $res[$item['id']] ['list'] = [];
            }
        }
        if (!empty($res)) {
            foreach ($res as $key => &$item) {
                $this->convertData($data, $item['id'], $item['list']);
            }
        }
    }
}
