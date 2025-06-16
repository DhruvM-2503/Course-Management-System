<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ReviewsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('reviews');

        $this->belongsTo('Users');
        $this->belongsTo('Courses');
    }
}
