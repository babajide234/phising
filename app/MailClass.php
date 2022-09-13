<?php
namespace Mail;
use \Mailjet\Resources;
use \Curl\Curl;
class MailClass {
    private $apikey;
    private $apisecret;
    function __construct() {
        $this->apikey = getenv('MJ_APIKEY_PUBLIC');
        $this->apisecret = getenv('MJ_APIKEY_PRIVATE');
    }
    public function apiRequest(){
        // $curl = new \Curl\Curl();
        // $curl->setHeader('Content-Type', 'application/json');
    }
    public function apiCall ($id,$body , $type , $resource){
        $mj = new \Mailjet\Client($this->apikey, $this->apisecret, true,['version' => 'v3']);
        switch ($type) {
            case 'post':
                if($id !== null){
                    $response = $mj->post($resource, ['id'=> $id ,'body' => $body]);
                }else{
                    $response = $mj->post($resource, ['body' => $body]);
                }
                break;
            case 'get':
                if($body !== null){
                    $response = $mj->get($resource,['body' => $body]);
                }else{
                    $response = $mj->get($resource);
                }
                break;
            case 'put':
                $response = $mj->put($resource, ['body' => $body]);
                break;
            case 'delete':
                $response = $mj->delete($resource);
                break;
            default:
                $response = $mj->post($resource, ['body' => $body]);
                break;
        }
        return $response;
    }
    public function addContact ($data){
        // return $this->apikey;
        $mj = new \Mailjet\Client($this->apikey, $this->apisecret, true,['version' => 'v3']);

        $body = [
            'IsExcludedFromCampaigns' => "false",
            'Name' => $data['name'],
            'Email' => $data['email'],
        ];
        // $response = $mj->post(Resources::$Contact, ['body' => $body]);
        // return $response;
        // return $body;
        $result = $this->apiCall(null,$body , 'post' , Resources::$Contact);
        return $result;

    }
    public function getContacts (){
        return $this->apiCall(null,null , 'get' , Resources::$Contact);
    }
   
    
    public function addContactsList ($contactListName){
        $body = [
            'Name' => $contactListName['name'],
        ];
        return $this->apiCall(null,$body , 'post' , Resources::$Contactslist);
    }
    
    public function getContactLists(){
        return $this->apiCall(null,null , 'get' , Resources::$Contactslist);
    }
    
    public function addContactToList ($data){
        $body = [
            'IsUnsubscribed' => true,
            'ContactID' => $data['ContactID'],
            'ListID' => $data['ListID'],
        ];
        return $this->apiCall(null,$body , 'post' , Resources::$Listrecipient);
    }

    public function sendMail(array $email) {

        $body = [
                    'FromEmail' => 'abj9us@gmail.com',
                    'FromName' => 'Test Name',   
                    'Recipients' => [
                    [
                        'Email' => $email['Email'],
                        'Name' => $email['Name']
                    ]
                    ],
                    'Subject' => $email['Subject'],
                    'Text-part' => "Dear passenger, welcome to Mailjet! May the delivery force be with you!",
                    'Html-part' => $email['TextPart'],
                    
        ];

        return $this->apiCall(null,$body , 'post' , Resources::$Email);
    }
    public function getContact($Id) {
        $body = [
            'id' => $Id
        ];
        return $this->apiCall(null,$body , 'get' , Resources::$Contact);
    }
    public function getMessages(){
        return $this->apiCall(null,null , 'get' , Resources::$Message);
    }

    public function getCampaignStats() {
        return $this->apiCall(null,null , 'get' , Resources::$Openinformation);
    }
    public function createTemplate($data) {
        $body = [
            'Author' => $data['author'],
            'Categories' => [],
            'Copyright' => "Mailjet",
            'Description' => $data['description'],
            'EditMode' => 1,
            'IsStarred' => false,
            'IsTextPartGenerationEnabled' => true,
            'Locale' => "en_US",
            'Name' => $data['name'],
            'OwnerType' => "user",
            'Presets' => "string",
            'Purposes' => []
        ];
        return $this->apiCall(null,$body , 'post' , Resources::$Template);
    }
    public function createTemplateContent($data) {
        $body = [
            'Headers' => "",
            'Html-part' => $data['html-part'],
            'MJMLContent' => "",
            'Text-part' => $data['text-part'],
          ];
        return $this->apiCall($data['id'], $body , 'post' , Resources::$TemplateDetailcontent);
    }
    public function getTemplates() {
        return $this->apiCall(null,null , 'get' , Resources::$Template);
    }
    public function getStastitics() {
        return $this->apiCall(null,null, 'get', Resources::$Openinformation);
    }
    public function getClickStastitics() {
        $body=[
            'FromTS' => '2018-01-01T00:00:00'
        ];
        return $this->apiCall(null,$body, 'get', Resources::$Clickstatistics);
    }
}
    