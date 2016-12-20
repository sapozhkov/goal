<?php

namespace app\helper;


use app\models\Goal;
use app\models\Task;

/**
 * Dashboard Helper
 */
class Dashboard {

    /**
     * Returns first overdue tasks
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Task[]
     */
    public static function getTasksOverdue(&$iTotalCount=0 ) {

        $query = Task::find()
            ->where(['closed' => 0])
            ->andWhere('date <= DATE(NOW())')
            ->orderBy('date')
            ->limit(10)
        ;

        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->all();

    }

    /**
     * Returns first tasks without date
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Task[]
     */
    public static function getTasksWithoutDate( &$iTotalCount=0 ) {

        $query = Task::find()
            ->where([
                'closed' => 0,
                'date' => null
            ])
            ->orderBy('id')
            ->limit(10)
        ;
        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->all();

    }

    /**
     * Returns first nearest tasks
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Task[]
     */
    public static function getTasksNearest(&$iTotalCount=0 ) {

        $query = Task::find()
            ->where(['closed' => 0])
            ->orderBy('date')
            ->limit(10)
        ;

        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->andWhere('date')->all();

    }

    /**
     * Returns first nearest goals
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Goal[]
     */
    public static function getGoalsNearest(&$iTotalCount=0 ) {

        $query = Goal::find()
            ->innerJoinWith('status')
            ->where('status.closed=0')
            ->orderBy('to_be_done_at')
            ->limit(7)
        ;

        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->andWhere('to_be_done_at')->all();

    }

    /**
     * Returns first goals without date
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Goal[]
     */
    public static function getGoalsWithoutDate( &$iTotalCount=0 ) {

        $query = Goal::find()
            ->innerJoinWith('status')
            ->where([
                'status.closed' => 0,
                'to_be_done_at' => null
            ])
            ->orderBy('goal.id')
            ->limit(10)
        ;

        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->all();

    }

    /**
     * Returns first overdue goals
     * @param int $iTotalCount if provided total count will be returned to this value
     * @return Goal[]
     */
    public static function getGoalsOverdue(&$iTotalCount=0 ) {

        $query = Goal::find()
            ->innerJoinWith('status')
            ->where('status.closed=0')
            ->andWhere('to_be_done_at <= DATE(NOW())')
            ->orderBy('goal.id')
            ->limit(10)
        ;

        if ( func_num_args() )
            $iTotalCount = $query->count();

        return $query->all();

    }

}