<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reglements Model
 *
 * @property \App\Model\Table\ReservationsTable&\Cake\ORM\Association\BelongsTo $Reservations
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Reglement newEmptyEntity()
 * @method \App\Model\Entity\Reglement newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Reglement> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reglement get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Reglement findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Reglement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Reglement> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reglement|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Reglement saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Reglement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reglement>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reglement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reglement> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reglement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reglement>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reglement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reglement> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ReglementsTable extends Table
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

        $this->setTable('reglements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);


        $this->belongsTo('Modespaiements', [
    'foreignKey' => 'modespaiement_id',
    'joinType' => 'LEFT'
    ]);





    $this->hasMany('Piecesreglements', [
    'foreignKey' => 'reglement_id',
    'dependent' => true,
    'cascadeCallbacks' => true,
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
            ->integer('reservation_id')
            ->notEmptyString('reservation_id');

        $validator
            ->integer('client_id')
            ->notEmptyString('client_id');

        $validator
            ->decimal('montant')
            ->requirePresence('montant', 'create')
            ->notEmptyString('montant');

        $validator
            ->dateTime('date_reglement')
            ->requirePresence('date_reglement', 'create')
            ->notEmptyDateTime('date_reglement');

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
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'), ['errorField' => 'reservation_id']);
        $rules->add($rules->existsIn(['client_id'], 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }
}
