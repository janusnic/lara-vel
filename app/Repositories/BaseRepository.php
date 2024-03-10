<?php
namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository implements BaseContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

         /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)     {
        return $this->model->create($attributes);
    }
     /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id) : bool     {
        return $this->find($id)->update($attributes);
    }

        /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     */
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc')     {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }
     /**
     * @param int $id
     */
    public function find(int $id)     {
        return $this->model->find($id);
    }

    public function findOneOrFail(int $id)     {
        return $this->model->findOrFail($id);
    }
    public function findBy(array $data)     {
        return $this->model->where($data)->all();
    }
    public function findOneBy(array $data)     {
        return $this->model->where($data)->first();
    }
    public function findOneByOrFail(array $data)     {
        return $this->model->where($data)->firstOrFail();
    }
    public function delete(int $id) : bool     {
        return $this->model->find($id)->delete();
    }

}
