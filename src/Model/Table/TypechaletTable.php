<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Typechalet Model
 *
 * @method \App\Model\Entity\Typechalet newEmptyEntity()
 * @method \App\Model\Entity\Typechalet newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Typechalet> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Typechalet get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Typechalet findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Typechalet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Typechalet> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Typechalet|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Typechalet saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Typechalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Typechalet>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Typechalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Typechalet> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Typechalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Typechalet>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Typechalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Typechalet> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TypechaletTable extends Table
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

        $this->setTable('typechalet');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
