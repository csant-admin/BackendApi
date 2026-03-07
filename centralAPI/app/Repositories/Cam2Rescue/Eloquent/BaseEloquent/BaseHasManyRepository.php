<?php

    namespace App\Repositories\Cam2Rescue\Eloquent\BaseEloquent;

    abstract class BaseHasManyRepository implements HasManyRepositoryInterface {
        abstract protected function getModel(): string;
        public function replaceByUserId(string $userId, array $rows): void {
            $model = $this->modelClass();
            $model::where('user_id', $userId)->delete();
            if (!empty($rows)) {
                foreach ($rows as &$row) {
                    $row['user_id'] = $userId;
                    unset($row['Id']); 
                }
                unset($row);

                $model::insert($rows);
            }
        }
    }