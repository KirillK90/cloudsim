<?php

class UrlHelperTest extends CTestCase
{
    public function testLinkedin()
    {
        $url = 'https://www.linkedin.com/';
        $this->assertEquals(UrlType::LIN, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://ru.linkedin.com/pub/andrey-abramov/41/162/57a/en';
        $normalUrl = 'https://www.linkedin.com/pub/andrey-abramov/41/162/57a';
        $this->assertEquals(UrlType::LIN, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::LIN, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'https://www.linkedin.com/profile/view?id=22762279&authType=OUT_OF_NETWORK&authToken=yMw3&locale=en_US&srchid=2274667961413984011578&srchindex=3&srchtotal=711&trk=vsrp_people_res_name&trkInfo=VSRPsearchId%3A2274667961413984011578%2CVSRPtargetId%3A22762279%2CVSRPcmpt%3Aprimary';
        $normalUrl = 'https://www.linkedin.com/profile/view?id=22762279';
        $this->assertEquals(UrlType::LIN, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::LIN, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'https://www.linkedin.com/profile/view?authType=name&locale=en_US&id=41589261&trk=ppro_viewmore&pvs=pp&authToken=OVuh';
        $normalUrl = 'https://www.linkedin.com/profile/view?id=41589261';
        $this->assertEquals(UrlType::LIN, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::LIN, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));
    }

    public function testHeadHunter()
    {
        $url = 'http://podolsk.hh.ru/';
        $this->assertEquals(UrlType::HH, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://podolsk.hh.ru/employer/targetresumes?searchPeriod=0&filterText=wegqg&itemsOnPage=20';
        $this->assertEquals(UrlType::HH, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://podolsk.hh.ru/resume/7832fd0a0000adcbb200107311736563726574?query=linkedin';
        $normalUrl = 'http://hh.ru/resume/7832fd0a0000adcbb200107311736563726574';
        $this->assertEquals(UrlType::HH, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::HH, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'http://hh.ru/applicant/resumes/view?resume=df7189f9ff0179b5fd0039ed1f353038645a58&query=linkedin';
        $normalUrl = 'http://hh.ru/resume/df7189f9ff0179b5fd0039ed1f353038645a58';
        $this->assertEquals(UrlType::HH, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::HH, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));
    }

    public function testVk()
    {
        $url = 'http://vk.com/';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'https://vkontakte.ru/search?c%5Bq%5D=rewgawe&c%5Bsection%5D=auto';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'https://vk.com/albums-42855938';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/doc1476410_337939122?hash=9c91532eaff5e654b0&dl=57bc15e54136895c5b';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/login?act=mobile&hash=7b64edd46cbabf9d';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/login.php?m=1&email=dox_uzza%40mail.ru';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/al_im.php?peers=8617926';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/feed?z=photo-34908971_341498712%2Ffeed1_-34908971_1412799674';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/album87831940_000?rev=1';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/fave?section=users';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://vk.com/settings?act=privacy';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(null, UrlHelper::getType($url));
        $this->assertEquals(null, UrlHelper::normalize($url));

        $url = 'http://www.vk.com/rey4eel';
        $normalUrl = 'http://vk.com/rey4eel';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::VK, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'https://vkontakte.ru/id3296234';
        $normalUrl = 'http://vk.com/id3296234';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::VK, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'http://vk.com/id69838672?z=photo69838672_284696759%2Falbum69838672_0%2Frev';
        $normalUrl = 'http://vk.com/id69838672';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::VK, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));

        $url = 'https://vk.com/likefifa/master?act=s&id=45669631&z=photo-45669631_343329600%2Fwall-45669631_4800';
        $normalUrl = 'http://vk.com/likefifa';
        $this->assertEquals(UrlType::VK, UrlHelper::getSite($url));
        $this->assertEquals(UrlType::VK, UrlHelper::getType($url));
        $this->assertEquals($normalUrl, UrlHelper::normalize($url));


    }
}
