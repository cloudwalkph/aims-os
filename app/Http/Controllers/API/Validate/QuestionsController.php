<?php
namespace App\Http\Controllers\API\Validate;

use App\Http\Controllers\Controller;
use App\Repositories\Validate\QuestionsRepository;
use App\User;
use Illuminate\Http\Request;

class QuestionsController extends Controller {

    /**
     * @var QuestionsRepository
     */
    protected $question;

    /**
     * QuestionsController constructor.
     * @param $question
     */
    public function __construct(QuestionsRepository $question)
    {
        $this->question = $question;
    }


    public function getQuestions(Request $request, $rateeId, $jobOrderId, $validateType)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['unauthorized', 401]);
        }

        $ratee = User::where('id', $rateeId)->first();

        $questions = $this->question->getQuestions($user->department_id, $ratee->department_id, $jobOrderId, $validateType);

        return response()->json($questions, 200);
    }
}