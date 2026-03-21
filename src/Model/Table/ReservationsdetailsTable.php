<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reservationsdetails Model
 *
 * @property \App\Model\Table\ReservationsTable&\Cake\ORM\Association\BelongsTo $Reservations
 * @property \App\Model\Table\ChaletsTable&\Cake\ORM\Association\BelongsTo $Chalets
 * @property \App\Model\Table\TarifsTable&\Cake\ORM\Association\BelongsTo $Tarifs
 *
 * @method \App\Model\Entity\Reservationsdetail newEmptyEntity()
 * @method \App\Model\Entity\Reservationsdetail newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Reservationsdetail> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservationsdetail get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Reservationsdetail findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Reservationsdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Reservationsdetail> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservationsdetail|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Reservationsdetail saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Reservationsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservationsdetail>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservationsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservationsdetail> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservationsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservationsdetail>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservationsdetail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservationsdetail> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ReservationsdetailsTable extends Table
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

        $this->setTable('reservationsdetails');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Chalets', [
            'foreignKey' => 'chalet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tarifs', [
            'foreignKey' => 'tarif_id',
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
            ->integer('reservation_id')
            ->notEmptyString('reservation_id');

        $validator
            ->integer('chalet_id')
            ->notEmptyString('chalet_id');

        $validator
            ->integer('tarif_id')
            ->allowEmptyString('tarif_id');

        $validator
            ->date('date_debut')
            ->requirePresence('date_debut', 'create')
            ->notEmptyDate('date_debut');

        $validator
            ->date('date_fin')
            ->requirePresence('date_fin', 'create')
            ->notEmptyDate('date_fin');

        $validator
            ->decimal('prix')
            ->requirePresence('prix', 'create')
            ->notEmptyString('prix');

        $validator
            ->scalar('statut')
            ->maxLength('statut', 50)
            ->allowEmptyString('statut');

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
        $rules->add($rules->existsIn(['chalet_id'], 'Chalets'), ['errorField' => 'chalet_id']);
        $rules->add($rules->existsIn(['tarif_id'], 'Tarifs'), ['errorField' => 'tarif_id']);

        return $rules;
    }
}
