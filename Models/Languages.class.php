<?php

/**
 * Language enum
 */
class Languages
{
    const IT = 1;
    const EN = 2;
    const DE = 3;

    protected $map = array();

    protected $selected;

    /**
     * @param array|null $rows
     */
    public function __construct(array $rows = null)
    {
        if (!empty($rows))
        {
            foreach ($rows as &$row)
            {
                $id = '' . $row['id'];
                $this->map[$id] = $row;
            }
            $this->selected = Languages::IT;
        }
    }

    public function select(int $id_lingua)
    {
        $this->selected = $id_lingua;
    }

    public function get(int $id_lingua): array
    {
        $id = '' . $id_lingua;
        return $this->map[$id] ?? array();
    }

    public function get_selected(): array
    {
        return $this->get($this->selected);
    }

    public function list_all(): array
    {
        return array_values($this->map);
    }
}