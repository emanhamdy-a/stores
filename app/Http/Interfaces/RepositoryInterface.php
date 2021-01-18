<?php


namespace App\Http\Interfaces;


interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $record);

    public function delete($id);

    public function show($id);
}
