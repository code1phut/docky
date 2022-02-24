<?php

/**
 * Author: anhnq
 * Date: 24-02-2022
 * Time: 09:35
 */
namespace ducky\Cores\Repositories\Eloquents;

use Ducky\Cores\Repositories\Interfaces\IBaseRepository;

abstract class BaseRepository implements IBaseRepository
{
    /** @var Model */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param string $id
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    /**
     * @param $model
     * @return mixed
     * @throws Exception
     */
    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);

        if ($result) {
            $result->delete();

            return $result;
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        $model = $this->model->withTrashed()->find($id);

        return $model->restore();
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function update($model, $data)
    {
        return $model->update($data);
    }
}