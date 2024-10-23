<?php

return[

        /**************************************************************************************
          Application
        **************************************************************************************/
        'application'=>[

                  /* Modules
                  **************************************************************************************/
                  'modules'=>[

                              /* configuration
                              **************************************************************************************/
                              'configuration'=>[

                                                  'controller'=>'Application\Modules\Configuration',
                                                  'view'=>'application.modules.configuration',
                                                  'name'=>'application.modules.configuration',
                                                  'layout'=>'application.layouts.modules.configuration',

                              ], //End Configuration


                              /* Landing
                              **************************************************************************************/
                              'landing'=>[

                                  /* CERVIE
                                  **************************************************************************************/
                                  'cervie'=>[

                                        'controller'=>'Application\Modules\Landing\Cervie',
                                        'view'=>'application.modules.landing.cervie',
                                        'name'=>'application.modules.landing.cervie',
                                        'layout'=>'application.layouts.modules.landing.cervie',

                                  ], //End CERVIE

                              ], //End Landing

                              /* Dashboard
                              **************************************************************************************/
                              'dashboard'=>[

                                            /* Employee
                                            **************************************************************************************/
                                            'employee'=>[

                                                'controller'=>'Application\Modules\Dashboard\Employee',
                                                'view'=>'application.modules.dashboard.employee',
                                                'name'=>'application.modules.dashboard.employee',
                                                'layout'=>'application.layouts.modules.dashboard.employee',

                                            ], //End Employee

                                            /* Researcher
                                            **************************************************************************************/
                                            'researcher'=>[
                                                'controller'=>'Application\Modules\Dashboard\Researcher',
                                                'view'=>'application.modules.dashboard.researcher',
                                                'name'=>'application.modules.dashboard.researcher',
                                                'layout'=>'application.layouts.modules.dashboard.researcher',
                                            ], //End Researcher

                              ], //End Dashboard

                              /* Error
                              **************************************************************************************/
                              'error'=>[


                                        'controller'=>'Application\Modules\Error',
                                        'view'=>'application.modules.error',
                                        'name'=>'application.modules.error',
                                        'layout'=>'application.layouts.modules.error',

                              ], //End Dashboard

                  ],


        ], //End Application

]

?>
