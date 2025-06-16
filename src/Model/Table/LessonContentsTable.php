<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonContents Model
 *
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\BelongsTo $Lessons
 *
 * @method \App\Model\Entity\LessonContent newEmptyEntity()
 * @method \App\Model\Entity\LessonContent newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\LessonContent> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonContent get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\LessonContent findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\LessonContent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\LessonContent> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonContent|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\LessonContent saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\LessonContent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonContent>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonContent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonContent> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonContent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonContent>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonContent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonContent> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonContentsTable extends Table
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

        $this->setTable('lesson_contents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
            'joinType' => 'INNER',
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
            ->integer('lesson_id')
            ->notEmptyString('lesson_id');

        $validator
            ->scalar('content_type')
            ->allowEmptyString('content_type');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

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
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'), ['errorField' => 'lesson_id']);

        return $rules;
    }
}
