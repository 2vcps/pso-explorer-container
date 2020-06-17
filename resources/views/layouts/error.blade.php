{{-- Show error messages if set --}}
@IF (session('message') or $errors->any())
    <div class="row">
        <div class="col-xs-12 tab-container">
            <div class="with-padding">
                <div class="no-left-padding col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span>System messages</span>
                        </div>
                        <div class="panel-body list-container">
                            <div class="row with-padding margin-left">
                                @IF(session('message') !== null)
                                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                        {{ session('message') }}
                                    </div>
                                @ENDIF
                                @IF ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="ibox-content" style="">
                                            <div class="alert alert-danger">
                                                {{ $error }}
                                            </div>
                                        </div>
                                    @endforeach
                                @ENDIF
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@ENDIF

{{-- Show error message if K8S is not found --}}
@IF (session('source') !== null)
    <div class="row">
        <div class="col-xs-12 tab-container">
            <div class="with-padding">
                <div class="no-left-padding col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @IF (session('source') == 'k8s')
                                <span>Unable to connect to Kubernetes cluster</span>
                            @ELSE
                                <span>Pure Service Orchestrator not found</span>
                            @ENDIF
                        </div>
                        <div class="panel-body list-container">
                            <div class="row with-padding margin-left">
                                @IF (session('source') == 'k8s')
                                    <h3><p>Error while connecting to Kubernetes</p></h3>
                                    <p>We ran into an error while connecting to the Kubernetes API service. To resolve this issue, make sure {{ config('app.name', 'PSO Analytics GUI') }} has access to the Kubernetes API services and that the roles and rolebindings are configured correctly.</p><br>
                                    <p>For more information on how to install and configure {{ config('app.name', 'PSO Analytics GUI') }} correctly, please visit: <br><a href="https://github.com/PureStorage-OpenConnect/pso-analytics-gui" target="_blank">https://github.com/PureStorage-OpenConnect/pso-analytics-gui</a></p>
                                @ELSE
                                    <p><strong>The Pure Storage Pure Service Orchestrator was not foundor not correctly configured</strong></p>
                                    <p>Please make sure you have installed the Pure Service Orchstrator (PSO) in your Kubernetes cluster.</p>
                                    <p>
                                        For installation instruction of PSO, please visit<br>
                                        <a href="https://github.com/purestorage/helm-charts" target="_blank">https://github.com/purestorage/helm-charts</a>
                                    </p>

                                    <p><strong>Validation of values.yaml syntax:</strong></p>
                                    <p>Also make sure your values.yaml file is formatted as shown below. Please note that YAML is case sensitive</p>

                                    <table style="vertical-align:top; width:100%">
                                        <tr>
                                            <td style="vertical-align:top; width:45%">
                                                <strong>Correct usage</strong>
                                                <pre>arrays:
  FlashArrays:
    - MgmtEndPoint: "IP address"
      APIToken: "API token"
  FlashBlades:
    - MgmtEndPoint: "IP address"
      APIToken: "API token"
      NfsEndPoint: "IP address"</pre>

                                                <p>Or when using labels:</p>

                                                <pre>arrays:
  FlashArrays:
    - MgmtEndPoint: "IP address"
      APIToken: "API token"
      Labels:
        topology.purestorage.com/datacenter: "my datacenter"
  FlashBlades:
    - MgmtEndPoint: "IP address"
      APIToken: "API token"
      NfsEndPoint: "IP address"
      Labels:
        topology.purestorage.com/datacenter: "my datacenter"</pre>
                                            </td>
                                            <td style="vertical-align:top; width:10%"> </td>
                                            <td style="vertical-align:top; width:45%">
                                                <strong>Current settings for PSO</strong>
                                                <pre>{{ session('yaml') }}</pre>
                                            </td>
                                        </tr>
                                    </table>
                                @ENDIF
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@ENDIF

