<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chalets Model
 *
 * @method \App\Model\Entity\Chalet newEmptyEntity()
 * @method \App\Model\Entity\Chalet newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Chalet> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chalet get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Chalet findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Chalet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Chalet> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chalet|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Chalet saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Chalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chalet>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chalet> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chalet>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Chalet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Chalet> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ChaletsTable extends Table
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

        $this->setTable('chalets');
        $this->setDisplayField('nom_chalet');
        $this->setPrimaryKey('id_chalet');


        $this->belongsTo('Typechalets', [
            'foreignKey' => 'typechalet_id',
            'joinType' => 'INNER', // ou 'INNER' si obligatoire
        ]);
        $this->hasMany('Chalets', [
            'foreignKey' => 'typechalet_id',
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
            ->scalar('nom_chalet')
            ->maxLength('nom_chalet', 100)
            ->requirePresence('nom_chalet', 'create')
            ->notEmptyString('nom_chalet');

        $validator
            ->integer('typechalet_id')
            ->requirePresence('typechalet_id', 'create')
            ->notEmptyString('typechalet_id');


        $validator
            ->integer('capacite')
            ->requirePresence('capacite', 'create')
            ->notEmptyString('capacite');

        $validator
            ->decimal('prix_par_nuit')
            ->requirePresence('prix_par_nuit', 'create')
            ->notEmptyString('prix_par_nuit');

        $validator
            ->scalar('statut')
            ->allowEmptyString('statut');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');



        return $validator;
    }
}
