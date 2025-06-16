<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lessons Model
 *
 * @property \App\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\LessonContentsTable&\Cake\ORM\Association\HasMany $LessonContents
 *
 * @method \App\Model\Entity\Lesson newEmptyEntity()
 * @method \App\Model\Entity\Lesson newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Lesson> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lesson get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Lesson findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Lesson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Lesson> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lesson|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Lesson saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lesson> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('lessons');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('LessonContents', [
            'foreignKey' => 'lesson_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('Quizzes', [
            'foreignKey' => 'lesson_id',
            'dependent' => true
        ]);

        $this->hasMany('LessonUserProgress', [
    'foreignKey' => 'lesson_id',
    'className' => 'LessonUserProgress'
]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('course_id')
            ->notEmptyString('course_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);

        return $rules;
    }
}
