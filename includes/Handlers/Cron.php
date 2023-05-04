<?php 

namespace Cpamatica\Includes\Handlers;

class Cron
{
    private const EVENT_PREFIX = "cron_";
    
    // All CRON events defined
    private const CRON_EVENTS = [
        [
            'name'      => self::EVENT_PREFIX . 'update_posts',
            'action'    => [ Post::class, 'update_posts' ],
            'time'      => '+24 hours' ,
        ],
    ];

    public function __construct( )
    {
        $this->load_events();
    }

    private function load_events( ) : void
    {
        foreach ( self::CRON_EVENTS as $event ) {
            add_action($event['name'],  $event['action']);
            wp_schedule_single_event(strtotime($event['time']), $event['name']);
        }
    }
}

( new Cron() );