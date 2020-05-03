<?php

namespace App\Custom\Api\Repositories;


abstract class Repository
{
    /**
     * Default number of items to show with pagination
     */
    const PAGINATION_DEFAULT = 10;

    /**
     * Model class name
     *
     * @var string
     */
    protected $modelClassName;

    /**
     * Create a new entity of a model
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->modelClassName->create($attributes);
    }

    /**
     * Get all entities of a model
     *
     * @return mixed
     */
    public function all()
    {
        return $this->modelClassName->all();
    }

    /**
     * Find one entity by its identifier
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->modelClassName->find($id);
    }

    /**
     * Find one entity by its identifier or fail
     *
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->modelClassName->findOrFail($id);
    }

    /**
     * Find entity by column attribute
     *
     * @param $attribute
     * @param $column
     * @return mixed
     */
    public function findBy($attribute, $column)
    {
        return $this->modelClassName->where($attribute, $column)->get();
    }

    /**
     * Paginate a list of entities
     *
     * @param int $pagination
     * @return mixed
     */
    public function paginate($pagination = self::PAGINATION_DEFAULT)
    {
        return $this->modelClassName->paginate($pagination);
    }

    /**
     * Update an entity
     *
     * @param null $id
     * @param array $data
     */
    public function update($id = null, $data = array())
    {
        return $this->modelClassName->findOrFail($id)->update($data);
    }

    /**
     * Destroy a list of entities by their identifiers
     *
     * @param $ids
     * @return mixed
     */
    public function destroy($ids)
    {
        return $this->modelClassName->destroy($ids);
    }

    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

}
