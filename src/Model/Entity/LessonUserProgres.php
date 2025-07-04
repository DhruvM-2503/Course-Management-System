<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonUserProgres Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $lesson_id
 * @property bool|null $quiz_passed
 * @property \Cake\I18n\DateTime|null $completed_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Lesson $lesson
 */
class LessonUserProgres extends Entity
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
        'user_id' => true,
        'lesson_id' => true,
        'quiz_passed' => true,
        'completed_at' => true,
        'user' => true,
        'lesson' => true,
    ];
}
