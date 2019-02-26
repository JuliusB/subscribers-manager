<?php declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\FieldsManager;
use App\Components\Subscribers\Http\Requests\StoreField;
use App\Components\Subscribers\Http\Requests\UpdateField;
use App\Components\Subscribers\Http\Resources\Field;
use App\Components\Subscribers\Models\Field as FieldModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class FieldController
 *
 * @package App\Http\Controllers\API\V1
 */
class FieldController extends Controller
{
    /** @var FieldsRepositoryContract */
    protected $fieldsRepository;

    /** @var FieldsManager */
    protected $fieldsManager;

    public function __construct(
        FieldsRepositoryContract $fieldsRepository,
        FieldsManager $fieldsManager
    ) {
        $this->fieldsRepository = $fieldsRepository;
        $this->fieldsManager = $fieldsManager;
    }

    /**
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $fields = $this->fieldsRepository->getFieldsList((int) $request->get('per_page'));

        return Field::collection($fields);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreField $request
     *
     * @return Field
     */
    public function store(StoreField $request): Field
    {
        $subscriber
            = $this->fieldsManager->createField(collect($request->validated()));

        return new Field($subscriber);
    }

    /**
     * Display the specified resource.
     *
     * @param  FieldModel $field
     *
     * @return Field
     */
    public function show(FieldModel $field): Field
    {
        return new Field($field);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateField $request
     * @param  FieldModel  $field
     *
     * @return Field
     */
    public function update(UpdateField $request, FieldModel $field): Field
    {
        $field = $this->fieldsManager->updateField(
            collect($request->validated()),
            $field
        );

        return new Field($field);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FieldModel $field
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(FieldModel $field)
    {
        try {
            $this->fieldsManager->deleteField($field);
        } catch (\Exception $exception) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
