<?php

namespace AutoDocumentation\Console\Commands;

use AutoDocumentation\Documentation;
use Illuminate\Console\Command;

class GenerateDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-doc:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate documentation';

    /**
     * @return void
     */
    public function handle(Documentation $documentation)
    {
        $doc = new \Docs\Documentation();

        $api = $doc->resolveOpenApi();


//        $api = (new OpenApi())
//            ->servers([
//                Server::make('http://localhost:8000/{locale}')
//                    ->description('My description')
//                    ->variable(Variable::make('locale', 'en')->enum(['en', 'ua'])),
//            ])
//            ->security(SanctumAuth::make())
//            ->paths([
//                Path::make('/users')
//                    ->methods([
//                        Method::make('get')
//                            ->security(SanctumAuth::make())
//                            ->parameter(UserIdParameter::make())
//                            ->servers([
//                                Server::make('http://bebebe:8000/{locale}')
//                                    ->description('My description')
//                                    ->variable(Variable::make('locale', 'en')->enum(['en', 'ua'])),
//                            ])
//                            ->request(
//                                Request::make()
//                                    ->content([
//                                        Content::make('application/json')
//                                            ->schema(
//                                                TestComponent::make()
//                                            ),
//                                    ])
//                            )
//                            ->responses([
//                                SuccessfulResponse::make(),
//                                NoContentResponse::make(),
//                            ]),
//                    ]),
//            ]);

//        dd($api->generate());

        $this->warn('Generating documentation ...');

        $documentation->generate($api);

        $this->info('Documentation generated! Visit: '.route('auto-documentation.documentation'));
    }
}
