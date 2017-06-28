<?php
namespace App\Http\Controllers\API\JobOrders;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectAttachment\CreateProjectAttachmentRequest;
use App\Models\JobOrder;
use App\Models\JobOrderProjectAttachment;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class ProjectAttachmentController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $joId)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderProjectAttachment::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderProjectAttachment::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_project_attachments.job_order_id')
            ->where('job_order_project_attachments.job_order_id', '=', $joId)
            ->select('job_order_project_attachments.*', 'job_orders.job_order_no');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderProjectAttachment::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateProjectAttachmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProjectAttachmentRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo, $request) {

            $jo = JobOrder::where('id', $input['job_order_id'])->first();

            $file = $request->file('file');
            $filename = $jo->job_order_no.'-'.$file->getFilename().'.'.$file->extension();

            // Move to storage
            $path = $file->storeAs('project-attachments', $filename);

            // Attachment data
            $data = [
                'job_order_id'      => $input['job_order_id'],
                'file_name'         => $filename,
                'reference_for'     => $input['reference_for']
            ];

            $jo = JobOrderProjectAttachment::create($data);

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrderProjectAttachment::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }

    public function download($attachmentId)
    {
        $attachment = JobOrderProjectAttachment::where('id', $attachmentId)->first();

        $filename = 'app/project-attachments/'.$attachment->file_name;

        $file = storage_path($filename);

        return response()->download($file, $attachment->file_name);
    }
}