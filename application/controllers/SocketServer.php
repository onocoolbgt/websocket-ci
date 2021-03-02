<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SocketServer extends CI_Controller
{

    protected $clients;

    protected $channelList = [
        'public',
        'test1',
        'test2'
    ];

    protected $userChannel;

    public function start()
    {
        $this->load->library('Ci_websocket');
        foreach ($this->channelList as $ch) {
            $this->userChannel[$ch] = new SplObjectStorage;
        }
        $this->ci_websocket->set_callback('msg', array($this, '_onMsg'));
        $this->ci_websocket->set_callback('open', array($this, '_onOpen'));
        $this->ci_websocket->set_callback('close', array($this, '_onClose'));
        $this->ci_websocket->run();
        // print_r($this->config);
    }

    public function _onOpen($clients, $client)
    {
        $rid = $client->resourceId;
        // insert client to cleint list
        $this->clients = $clients;
        $this->printUserChannel();
        output('info', "New Connection ($rid)");
    }

    /**
     * Function onMessage
     *
     * @param [type] $from
     * @param [type] $msg
     * @param [type] $clients
     * @return void
     */
    public function _onMsg($from = NULL, $msg = NULL, $all_clients = NULL)
    {
        output('info', "Message : $msg");
        foreach ($this->clients as $client) {
            output('info', "User : {$client->resourceId}");
        }
        if (valid_json($msg)) {
            $msgData = json_decode($msg);
            if ($msgData->type == 'join') {
                if (!empty($msgData->username)) {
                    $from->username = $msgData->username;
                }
                if (!empty($msgData->channel) && in_array($msgData->channel, $this->channelList)) {
                    $this->userChannel[$msgData->channel]->attach($from);
                    $this->printUserChannel();
                    $this->broadcastChannel($msgData->channel, $msgData);
                } else {
                }
                // output('info', $from->username);
            }
            if ($msgData->type == 'chat') {
                if (!empty($msgData->message)) {
                    if (!empty($msgData->channel) && in_array($msgData->channel, $this->channelList)) {
                        $this->broadcastChannel($msgData->channel, $msgData);
                    }
                }
            }
        }
    }

    public function _onClose($clients, $client)
    {
        $rid = $client->resourceId;
        // renew clients list
        $this->clients = $clients;
        foreach ($this->userChannel as $uci => $uc) {
            foreach ($uc as $cc) {
                if ($cc->resourceId == $client->resourceId) {
                    $this->userChannel[$uci]->detach($cc);
                    output('info', "{$cc->username}({$cc->resourceId}) Disconnect");
                    $this->broadcastChannel($uci, json_encode(['username' => $cc->username, 'channel' => $uci, 'type' => 'leave']));
                    $this->printUserChannel();
                }
            }
        }
        // output('info', "($rid) Disconnect");
    }

    function printUserChannel()
    {
        foreach ($this->userChannel as $chi => $ch) {
            $cci = [];
            foreach ($ch as $cc) $cci[] = "{$cc->username}({$cc->resourceId})";
            $cci = join(',', $cci);
            output('info', "CH : $chi\t\t| User : $cci");
        }
    }

    function broadcastChannel($channel = '', $msg)
    {
        output('info', 'broadcasting at "' . $channel . '"');
        foreach ($this->userChannel[$channel] as $cc) {
            $cc->send(valid_json($msg) ? $msg : json_encode($msg));
        }
    }

    /**
     * Function to send the message
     * @method send_message
     * @param object $to User to send
     * @param array $message Message
     * @param object $client Sender
     * @return string
     */
    protected function _send_message($to = array(), $message = array(), $from = array())
    {
        // Send the message
        $to->send($message);
    }
}
