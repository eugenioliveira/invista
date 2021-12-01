<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $addressable_id
 * @property string $addressable_type
 * @property string $street
 * @property string $number
 * @property string|null $apt_room
 * @property string $neighbourhood
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $addressable
 * @method static \Database\Factories\AddressFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAptRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereNeighbourhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Allotment
 *
 * @property int $id
 * @property string $title
 * @property string|null $cover
 * @property int $city_id
 * @property int $active
 * @property mixed $area
 * @property string|null $latitude
 * @property string|null $longitude
 * @property mixed $max_discount
 * @property mixed $reservation_duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read string $cover_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lot[] $lots
 * @property-read int|null $lots_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentPlan[] $plans
 * @property-read int|null $plans_count
 * @method static \Database\Factories\AllotmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereReservationDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allotment whereUpdatedAt($value)
 */
	class Allotment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property string $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Allotment[] $allotments
 * @property-read int|null $allotments_count
 * @property-read string $full_name
 * @method static \Database\Factories\CityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $cnpj
 * @property string $state_reg_id
 * @property string $phone
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $shareholders
 * @property-read int|null $shareholders_count
 * @method static \Database\Factories\CompanyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStateRegId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lot
 *
 * @property int $id
 * @property int $allotment_id
 * @property string $block
 * @property int $number
 * @property mixed $price
 * @property mixed $front
 * @property mixed $back
 * @property mixed $right
 * @property mixed $left
 * @property string $front_side
 * @property string $back_side
 * @property string $right_side
 * @property string $left_side
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Proposal|null $activeProposal
 * @property-read \App\Models\Reservation|null $activeReservation
 * @property-read \App\Models\Allotment $allotment
 * @property-read mixed $area
 * @property-read mixed $formatted_price
 * @property-read string $identification
 * @property-read \App\Models\LotStatus|null $latestStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Proposal[] $proposals
 * @property-read int|null $proposals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LotStatus[] $statuses
 * @property-read int|null $statuses_count
 * @method static \Database\Factories\LotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereAllotmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereBackSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereFrontSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereLeftSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereRightSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lot whereUpdatedAt($value)
 */
	class Lot extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LotStatus
 *
 * @property int $id
 * @property int $lot_id
 * @property int $user_id
 * @property \App\Enums\LotStatusType $type
 * @property string $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LotStatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereLotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotStatus whereUserId($value)
 */
	class LotStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentPlan
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property mixed $min_down_payment
 * @property \Illuminate\Database\Eloquent\Casts\AsCollection $installment_indexes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Allotment[] $allotments
 * @property-read int|null $allotments_count
 * @method static \Database\Factories\PaymentPlanFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereInstallmentIndexes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereMinDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentPlan whereUpdatedAt($value)
 */
	class PaymentPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Person
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $cpf
 * @property string $phone
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\PersonDetail|null $detail
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Proposal[] $proposals
 * @property-read int|null $proposals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PersonFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PersonDetail
 *
 * @property int $id
 * @property int $person_id
 * @property \App\Enums\CivilStatus $civil_status
 * @property mixed $birth_date
 * @property string $birth_location
 * @property string $nationality
 * @property string $rg
 * @property string $rg_issuer
 * @property string $occupation
 * @property string $email
 * @property mixed $monthly_income
 * @property string $father_name
 * @property string $mother_name
 * @property int|null $partner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Person|null $partner
 * @property-read \App\Models\Person $person
 * @method static \Database\Factories\PersonDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereBirthLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereCivilStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereMonthlyIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereMotherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereRgIssuer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonDetail whereUpdatedAt($value)
 */
	class PersonDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Proposal
 *
 * @property int $id
 * @property int $lot_id
 * @property int $user_id
 * @property int $reservation_id
 * @property int $proposeable_id
 * @property string $proposeable_type
 * @property int|null $payment_plan_id
 * @property \App\Enums\ProposalType $type
 * @property mixed $negotiated_value
 * @property mixed $down_payment
 * @property int $installments
 * @property mixed $installment_value
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProposalDocument[] $documents
 * @property-read int|null $documents_count
 * @property-read string $conditions
 * @property-read mixed $url
 * @property-read \App\Models\ProposalStatus|null $latestStatus
 * @property-read \App\Models\Lot $lot
 * @property-read \App\Models\PaymentPlan|null $paymentPlan
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $proposeable
 * @property-read \App\Models\Reservation $reservation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProposalStatus[] $statuses
 * @property-read int|null $statuses_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal active()
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereInstallmentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereInstallments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereLotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereNegotiatedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal wherePaymentPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereProposeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereProposeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proposal whereUserId($value)
 */
	class Proposal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProposalDocument
 *
 * @property int $id
 * @property int $proposal_id
 * @property string $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument whereProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalDocument whereUpdatedAt($value)
 */
	class ProposalDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProposalStatus
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $user_id
 * @property \App\Enums\ProposalStatusType $type
 * @property string $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProposalStatus whereUserId($value)
 */
	class ProposalStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property int $lot_id
 * @property int $user_id
 * @property int $reserveable_id
 * @property string $reserveable_type
 * @property \Illuminate\Support\Carbon $init
 * @property \Illuminate\Support\Carbon $due
 * @property \Illuminate\Support\Carbon|null $cancelled_at
 * @property string|null $reason
 * @property-read \App\Models\Lot $lot
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reserveable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation active()
 * @method static \Database\Factories\ReservationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereLotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReserveableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReserveableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $person_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Person $person
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

