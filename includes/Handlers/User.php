<?php 

namespace Cpamatica\Includes\Handlers;

class User
{
    private string $role;

    public function __construct( $args )
    {
        $this->role = $args['role'] ? $args['role'] : null;
    }

    public function get_users_by_role( ) : mixed
    {
        $args = [
            'role'    => $this->role,
            'orderby' => 'ID',
            'order'   => 'ASC'
        ];
          
        $users = get_users($args);

        return $users;
    }
}
