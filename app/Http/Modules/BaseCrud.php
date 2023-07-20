<?php

namespace App\Http\Modules;

use App\Http\Controllers\Controller;
use App\Traits\HasCrudHooks;
use App\Traits\HasCrudPrepareQuery;
use App\Traits\HasCrudSuccessResult;
use App\Traits\HasDBSafe;
use Illuminate\Http\Request;

class BaseCrud extends Controller
{

    use HasCrudHooks, HasCrudPrepareQuery, HasCrudSuccessResult, HasDBSafe;

    public $model;

    public $resource;

    public $row;

    public $searchAble = [];

    public $modelKey = 'uuid';

    public $storeValidator;

    public $updateValidator;

    public $relationList = [];

    public $relationShow = [];

    public $lockRelationParam = false;

    public $paginationPerPage = 10;

    public $defaultOrder = 'id';

    public $defaultSort = 'asc';

    public $requestData;


    public function index(Request $request)
    {
        $this->requestData = $request;

        $query = $this->model::query();

        $this->__prepareQueryRelationList($query);

        $this->__prepareQueryList($query);

        $this->__prepareQuerySearchAbleList($query);

        if ($ress = $this->__beforeList($query)) {
            return $ress;
        }

        $this->__prepareQuerySortAndLimit($query);

        $query = $this->__prepareQueryListType($query);

        $this->__prepareLoadRelation($query);

        return $this->__successList($query);
    }


    public function store(Request $request)
    {
        return $this->DBSafe(
            function () {
                $req = app($this->storeValidator);

                $this->requestData = $req;

                $dt = new $this->model();

                $data = $req->validated();

                $data = $this->__prepareDataStore($data);

                if ($ress = $this->__beforeStore()) {
                    return $ress;
                }

                $dt->fill($data);

                $dt->save();

                $this->row = $dt;

                if ($ress = $this->__afterStore()) {
                    return $ress;
                }

                $this->__prepareLoadRelation($this->row);

                return $this->__successStore();
            }
        );
    }

    public function show($id)
    {
        $query = $this->model::where($this->modelKey, $id);

        $this->__prepareQueryRelationShow($query);

        $this->__prepareQueryRowShow($query);

        $this->row = $query->firstOrFail();

        $this->__prepareLoadRelation($this->row);

        if ($ress = $this->__beforeShow()) {
            return $ress;
        }

        return $this->__successShow();
    }

    public function update(Request $request, $id)
    {
        return $this->DBSafe(
            function () use ($id) {
                $req = app($this->updateValidator);

                $this->requestData = $req;

                $query = $this->model::where($this->modelKey, $id);

                $this->__prepareQueryRowUpdate($query);

                $this->row = $query->firstOrFail();

                $data = $req->validated();

                $data = $this->__prepareDataUpdate($data);

                if ($ress = $this->__beforeUpdate()) {
                    return $ress;
                }

                $this->row->fill($data);

                $this->row->save();

                if ($ress = $this->__afterUpdate()) {
                    return $ress;
                }

                $this->__prepareLoadRelation($this->row);

                return $this->__successUpdate();
            }
        );
    }


    public function destroy($id)
    {
        return $this->DBSafe(
            function () use ($id) {

                $query = $this->model::where($this->modelKey, $id);

                $this->__prepareQueryRowDestroy($query);

                $this->row = $query->firstOrFail();

                if ($ress = $this->__beforeDestroy()) {
                    return $ress;
                }

                $this->row->delete();

                if ($ress = $this->__afterDestroy()) {
                    return $ress;
                }

                return $this->__successDestroy();
            }
        );
    }
}
