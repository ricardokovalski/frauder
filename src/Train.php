<?php

namespace RicardoKovalski\Frauder;

use Rubix\ML\Loggers\Screen;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Transformers\NumericStringConverter;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Rubix\ML\Classifiers\LogisticRegression;
use Rubix\ML\NeuralNet\Optimizers\StepDecay;
use Rubix\ML\CrossValidation\Reports\AggregateReport;
use Rubix\ML\CrossValidation\Reports\ConfusionMatrix;
use Rubix\ML\CrossValidation\Reports\MulticlassBreakdown;
use Rubix\ML\Persisters\Filesystem;

use function Rubix\ML\array_transpose;

final class Train implements TrainInterface
{
    protected string $dataset;

    public function __construct($dataset)
    {
        $this->dataset = $dataset;
    }

    public function train()
    {
        $logger = new Screen();

        $logger->info('Loading data into memory');

        $dataset = Labeled::fromIterator(new CSV($this->dataset, true))
            ->apply(new NumericStringConverter())
            ->apply(new ZScaleStandardizer());

        [$training, $testing] = $dataset->stratifiedSplit(0.8);

        $estimator = new LogisticRegression(256, new StepDecay(0.01, 100));

        $estimator->setLogger($logger);

        $estimator->train($training);

        $extractor = new CSV('results/progress.csv', true);

        $extractor->export($estimator->steps());

        $logger->info('Progress saved to progress.csv');

        $report = new AggregateReport([
            new MulticlassBreakdown(),
            new ConfusionMatrix(),
        ]);

        $logger->info('Making predictions');

        $predictions = $estimator->predict($testing);

        $results = $report->generate($predictions, $testing->labels());

        echo $results;

        $results->toJSON()->saveTo(new Filesystem('results/report.json'));

        $logger->info('Report saved to report.json');
    }
}