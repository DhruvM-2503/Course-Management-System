<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Certificates Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\Certificate newEmptyEntity()
 * @method \App\Model\Entity\Certificate newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Certificate> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Certificate get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Certificate findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Certificate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Certificate> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Certificate|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Certificate saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CertificatesTable extends Table
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

        $this->setTable('certificates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('course_id')
            ->notEmptyString('course_id');

        $validator
            ->dateTime('issued_at')
            ->allowEmptyDateTime('issued_at');

        $validator
            ->scalar('certificate_path')
            ->maxLength('certificate_path', 255)
            ->allowEmptyString('certificate_path');

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
        $rules->add($rules->isUnique(['user_id', 'course_id']), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);

        return $rules;
    }
}
