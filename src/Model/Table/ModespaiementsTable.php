<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modespaiements Model
 *
 * @method \App\Model\Entity\Modespaiement newEmptyEntity()
 * @method \App\Model\Entity\Modespaiement newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Modespaiement> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Modespaiement get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Modespaiement findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Modespaiement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Modespaiement> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Modespaiement|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Modespaiement saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Modespaiement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Modespaiement>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Modespaiement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Modespaiement> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Modespaiement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Modespaiement>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Modespaiement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Modespaiement> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ModespaiementsTable extends Table
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

        $this->setTable('modespaiements');
        $this->setDisplayField('nom');
        $this->setPrimaryKey('id');

        $this->hasMany('Piecesreglements', [
    'foreignKey' => 'modespaiement_id',
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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        return $validator;
    }
}
