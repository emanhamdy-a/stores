<?php


namespace App\Http\Interfaces;


interface ProcuctRepositoryInterface
{
  public function all();

  public function create();

  public function store(array $data);

  public function edit($id);

  public function update(array $data, $record);

  public function show($id);

  public function delete($product,$id);

  public function savePrice($request);

  public function saveStock($request);

  public function is_active($request);

}
