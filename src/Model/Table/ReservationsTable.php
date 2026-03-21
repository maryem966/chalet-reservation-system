<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reservations Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\ReservationDetailsTable&\Cake\ORM\Association\HasMany $ReservationDetails
 *
 * @method \App\Model\Entity\Reservation newEmptyEntity()
 * @method \App\Model\Entity\Reservation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Reservation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Reservation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Reservation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Reservation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Reservation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Reservation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Reservation> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Reservationsdetails', [
            'foreignKey' => 'reservation_id',
            'className' => 'Reservationsdetails',
            'dependent' => true,
            'cascadeCallbacks' => true,
            'saveStrategy' => 'append'

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
            ->integer('client_id')
            ->notEmptyString('client_id');

        $validator
            ->dateTime('date_reservation')
            ->allowEmptyDateTime('date_reservation');

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
        $rules->add($rules->existsIn(['client_id'], 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }
}
