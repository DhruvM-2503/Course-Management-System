<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonContent Entity
 *
 * @property int $id
 * @property int $lesson_id
 * @property string|null $content_type
 * @property string|null $content
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Lesson $lesson
 */
class LessonContent extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'lesson_id' => true,
        'content_type' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        'lesson' => true,
    ];
}
