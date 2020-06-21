<?php
/**
 * Smart Livraison
 *
 * LICENSE
 *
 * This source file is subject to the MIT License that is bundled
 * with this package in the file LICENSE.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to dev@adjemin.com so we can send you a copy immediately.
 *
 * @category   SmartLivraison
 * @package    SmartLivraison
 * @version    1.0.0
 * @license    MIT
 * @copyright  Copyright (c) 2020 Adjemin Inc. (https://adjemin.com)
 */

namespace SmartLivraison;


class TaskStatus
{

    const UNASSIGNED = "unassigned";
    const ASSIGNED = "assigned";
    const IN_PROGRESS = "in-progress";
    const FAILED = "failed";
    const SUCCESSFUL = "successful";
    const ACCEPTED = "accepted";

    //FOR JOB
    const JOB_UNASSIGNED = "unassigned";
    const JOB_ASSIGNED = "assigned";
    const JOB_ACCEPTED = "accepted";
    const JOB_REFUSED= "refused";
    const JOB_STARTED = "started";
    const JOB_CANCEL = "cancel";
    const JOB_SUCCESSFUL = "successful";
    const JOB_FAILED = "failed";


}
