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

                                          'controller'=>'Application\Modules\Landing',
                                          'view'=>'application.modules.landing',
                                          'name'=>'application.modules.landing',
                                          'layout'=>'application.layouts.modules.landing',

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
