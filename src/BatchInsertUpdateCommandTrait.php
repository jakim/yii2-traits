<?php

namespace jakim\traits;

trait BatchInsertUpdateCommandTrait
{
    public function batchInsertUpdateCommand(string $table, array $insertColumns, array $rows, array $updateColumns = [])
    {
        $sql = \Yii::$app->db->queryBuilder
            ->batchInsert($table, $insertColumns, $rows);
        $sql .= $this->prepareUpdatePart($insertColumns, $updateColumns);

        return \Yii::$app->db->createCommand($sql);
    }

    private function prepareUpdatePart(array $insertColumns, array $updateColumns = []): string
    {
        $updateColumns = $updateColumns ?: $insertColumns;
        $sql = [];
        foreach ($updateColumns as $column) {
            $sql[] = sprintf('[[%s]]=VALUES([[%s]])', $column, $column);
        }

        return ' ON DUPLICATE KEY UPDATE ' . implode(', ', $sql);
    }
}