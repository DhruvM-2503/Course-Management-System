<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonUserProgress Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\BelongsTo $Lessons
 *
 * @method \App\Model\Entity\LessonUserProgres newEmptyEntity()
 * @method \App\Model\Entity\LessonUserProgres newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\LessonUserProgres> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonUserProgres get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\LessonUserProgres findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\LessonUserProgres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\LessonUserProgres> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonUserProgres|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\LessonUserProgres saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\LessonUserProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonUserProgres>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonUserProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonUserProgres> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonUserProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonUserProgres>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\LessonUserProgres>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\LessonUserProgres> deleteManyOrFail(iterable $entities, array $options = [])
 */
class LessonUserProgressTable extends Table
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

        $this->setTable('lesson_user_progress');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
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
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('lesson_id')
            ->allowEmptyString('lesson_id');

        $validator
            ->boolean('quiz_passed')
            ->allowEmptyString('quiz_passed');

        $validator
            ->dateTime('completed_at')
            ->allowEmptyDateTime('completed_at');

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
        $rules->add($rules->isUnique(['user_id', 'lesson_id'], ['allowMultipleNulls' => true]), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'), ['errorField' => 'lesson_id']);

        return $rules;
    }
}
