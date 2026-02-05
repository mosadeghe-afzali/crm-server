<?php
namespace App\Repositories;

use App\Models\Position;

class PositionRepository {
    public function index($input = []) {
        return Position::select('id', 'name', 'department_id')->filter($input)->get();
    }

    public function show($input) {
        return Position::filter($input)->first();
    }

    public function create($input) {
        return Position::create($input);
    }

    public function find($position_id) {
        return Position::find($position_id);
    }

    public function update($input) {

        $position_id = $input['position_id'];
        unset($input['position_id']);

        Position::where('id', $position_id)->update($input);
    }
}
