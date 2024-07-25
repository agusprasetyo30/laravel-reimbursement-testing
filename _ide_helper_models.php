<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $reimbursement_id
 * @property bool|null $status
 * @property string|null $note
 * @property int $process_by
 * @property string $process_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $employee
 * @property-read \App\Models\Reimbursement $reimbursement
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement query()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereProcessBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereProcessDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereReimbursementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranReimbursement withoutTrashed()
 */
	class PembayaranReimbursement extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $reimbursement_id
 * @property bool|null $status
 * @property string|null $note
 * @property int $approved_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $approval_date
 * @property-read \App\Models\User $employee
 * @property-read \App\Models\Reimbursement $reimbursement
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereApprovalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereReimbursementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReimburseApproval withoutTrashed()
 */
	class ReimburseApproval extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property string $document_file_name
 * @property string $document_file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\PembayaranReimbursement|null $pembayaranReimbursement
 * @property-read \App\Models\ReimburseApproval|null $reimbursementApproval
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereDocumentFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereDocumentFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reimbursement withoutTrashed()
 */
	class Reimbursement extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $nip Nomer Induk Pegawai
 * @property string $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

