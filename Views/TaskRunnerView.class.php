<?php
require_once 'Views/IView.interface.php';

class TaskRunnerView implements IView
{
    /** @var IView */
    protected $inner_view;

    /** @var callable */
    protected $task_run;

    /**
     * @param IView $inner
     * @param callable $task_run
     */
    public function __construct(IView &$inner, callable $task_run)
    {
        $this->inner_view = $inner;
        $this->task_run = $task_run;
    }

    /**
     * Renders, flushes to client, then runs the task.
     */
    function render(): void
    {
        $this->inner_view->render();
        flush();
        if ($this->task_run != null)
        {
            $this->task_run();
        }
    }
}