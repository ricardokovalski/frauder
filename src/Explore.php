<?php

namespace RicardoKovalski\Frauder;

use Rubix\ML\Loggers\Screen;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Transformers\NumericStringConverter;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Rubix\ML\Transformers\TSNE;

final class Explore implements ExploreInterface
{
    protected string $dataset;

    public function __construct($dataset)
    {
        $this->dataset = $dataset;
    }

    public function explore()
    {
        $logger = new Screen();

        $logger->info('Loading data into memory');

        $dataset = Labeled::fromIterator(new CSV($this->dataset, true))
            ->apply(new NumericStringConverter());

        $stats = $dataset->describe();

        //echo $stats;

        $stats->toJSON()->saveTo(new Filesystem('stats.json'));

        $logger->info('Stats saved to stats.json');

        $dataset = $dataset->randomize()->head(2000);

        $embedder = new TSNE(2, 20.0, 20);

        $embedder->setLogger($logger);

        $dataset->apply(new OneHotEncoder())
            ->apply(new ZScaleStandardizer())
            ->apply($embedder)
            ->exportTo(new CSV('embedding.csv'));

        $logger->info('Embedding saved to embedding.csv');
    }
}