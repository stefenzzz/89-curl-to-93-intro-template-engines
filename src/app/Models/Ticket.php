<?php

declare(strict_types = 1);


namespace App\Models;

use App\Model;
use PDO;

class Ticket extends Model
{

    public function generatorExample()
    {
      $stmt = $this->db->query(
        'SELECT id, title, content
         FROM ticket'
      );


      return $this->fetchLazy($stmt);
    }
}