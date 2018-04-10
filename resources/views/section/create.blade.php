<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Assistant Scaffolding</title>

        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> --}}
        <link rel="stylesheet" type="text/css" href="css/all.css">
        <style type="text/css">
            [v-cloak] {
              display: none;
            }
        </style>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">             
            <div class="row" id="sectionApp" v-cloak>
                <div class="col-md-12">
                    <h1>Assistant Scaffolding</h1>
                    <div class="box box-primary">

                        <form id="form-section" action="/section" method="POST" {!! '@submit.prevent="validateBeforeSubmit"'!!}>
                            <div class="box-body">
                                
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="row">                            
                                    <div class=" col-md-6">@include('HTML_VUE.input_text', ['model'=>'single_name', 'name'=>'single_name', 'label'=>'Single name', 'validate'=>"'required'"])</div>
                                    <div class=" col-md-6">@include('HTML_VUE.input_text', ['model'=>'plural_name', 'name'=>'plural_name', 'label'=>'Plural name', 'validate'=>"'required'"])</div>
                                </div>
                                                  
                                <div class="form-group">
                                    <div class="pull-right">
                                        <a role="button" type="button" v-on:click="addAttribute" class="btn btn-primary btn-xs">
                                            <span class="glyphicon-plus glyphicon"></span>
                                        </a>
                                        <a role="button" v-on:click="removeAttribute" v-show="attributes.length > 1" class="btn btn-danger btn-xs">
                                            <span class="glyphicon-minus glyphicon"></span>
                                        </a>                                    
                                    </div>                                
                                    <label for="attributes">Attributes</label>
                                </div>

                                <div class="row" v-show="attributes.length > 0">
                                    <div class="col-md-2">Name</div>
                                    <div class="col-md-2">Type</div>
                                    <div class="col-md-2">Component</div>
                                    <div class="col-md-3">DB Modifiers</div>
                                    <div class="col-md-3">Validation</div>
                                </div>

                                <div class="row" v-for="(item, index) in attributes">

                                    <div class="col-md-2">
                                        <div class="form-group" :class="{'has-error': errors.has('attributes['+index+'][name]') }">
                                            <input  class="form-control input-sm" 
                                            type="text"
                                            v-model="attributes[index]['name']"
                                            :name="'attributes['+index+'][name]'" 
                                            v-validate="'required'"
                                            autocomplete="off" 
                                            placeholder="attribute name">

                                            <span class="help-block" v-if="errors.has('attributes['+index+'][name]')">@{{ errors.first('attributes['+index+'][name]') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" :class="{'has-error': errors.has('attributes['+index+'][type]') }">
                                            
                                            <select class="form-control input-sm" v-validate="'required'" v-model="attributes[index]['type']" :name="'attributes['+index+'][type]'">

                                                <option v-for="option in optionsTypes" :selected="item.type == option.value " :value="option.value">@{{option.text}}</option>
                                            </select>

                                            <span class="help-block" v-if="errors.has('attributes['+index+'][type]')">@{{errors.first('attributes['+index+'][type]')}}</span>    
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" :class="{'has-error': errors.has('attributes['+index+'][element]') }">
                                            
                                            <select class="form-control input-sm" v-validate="'required'" v-model="attributes[index]['element']" :name="'attributes['+index+'][element]'">

                                                <option v-for="option in optionsElements" :selected="item.element == option.value " :value="option.value">@{{option.text}}</option>
                                            </select>

                                            <span class="help-block" v-if="errors.has('attributes['+index+'][element]')">@{{errors.first('attributes['+index+'][element]')}}</span>    
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.has('attributes['+index+'][modifier]') }">
                                            <input  class="form-control input-sm" 
                                            type="text" 
                                            v-model="attributes[index]['modifier']"
                                            :name="'attributes['+index+'][modifier]'" 
                                            v-validate="'max:191'"
                                            autocomplete="off" 
                                            placeholder="modifier string">

                                            <span class="help-block" v-if="errors.has('attributes['+index+'][modifier]')">@{{ errors.first('attributes['+index+'][modifier]') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.has('attributes['+index+'][validate]') }">
                                            <input  class="form-control input-sm" 
                                            type="text" 
                                            v-model="attributes[index]['validate']"
                                            :name="'attributes['+index+'][validate]'" 
                                            v-validate="'required'"
                                            autocomplete="off" 
                                            placeholder="rules string">

                                            <span class="help-block" v-if="errors.has('attributes['+index+'][validate]')">@{{ errors.first('attributes['+index+'][validate]') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12" v-show="attributes[index]['type'] == 'json' ">
                                        <textarea></textarea>
                                    </div>
                                </div>
                                
                                

                                <div class="form-group">
                                    <div class="pull-right">
                                        <a role="button" type="button" v-on:click="addRelationship" class="btn btn-primary btn-xs">
                                            <span class="glyphicon-plus glyphicon"></span>
                                        </a>
                                        <a role="button" v-if="relationships.length > 0" v-on:click="removeRelationship" class="btn btn-danger btn-xs">
                                            <span class="glyphicon-minus glyphicon"></span>
                                        </a>                                    
                                    </div>                                
                                    <label for="relations">Relationships</label>
                                </div>


                                <div class="row" v-show="relationships.length > 0">
                                    <div class="col-md-2">Name</div>
                                    <div class="col-md-3">Type</div>
                                    <div class="col-md-7">Relationship args</div>                            
                                </div>

                                <div class="row" v-for="(item, index) in relationships">

                                    <div class="col-md-2">
                                        <div class="form-group" :class="{'has-error': errors.has('relationships['+index+'][name]') }">
                                            <input  class="form-control input-sm" 
                                            type="text" 
                                            v-model="relationships[index]['name']"
                                            :name="'relationships['+index+'][name]'" 
                                            v-validate="'required'"
                                            autocomplete="off" 
                                            placeholder="relationship name">

                                            <span class="help-block" v-if="errors.has('relationships['+index+'][name]')">@{{ errors.first('relationships['+index+'][name]') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.has('relationships['+index+'][type]') }">
                                            
                                            <select class="form-control input-sm" v-validate="'required'" v-model="relationships[index]['type']" :name="'relationships['+index+'][type]'">

                                                <option v-for="option in optionsRelationships" :selected="item.type == option.value " :value="option.value">@{{option.text}}</option>
                                            </select>

                                            <span class="help-block" v-if="errors.has('relationships['+index+'][type]')">@{{errors.first('relationships['+index+'][type]')}}</span>    
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" :class="{'has-error': errors.has('relationships['+index+'][args]') }">
                                            <input  class="form-control input-sm" 
                                            type="text" 
                                            v-model="relationships[index]['args']"
                                            :name="'relationships['+index+'][args]'" 
                                            v-validate="'required'"
                                            autocomplete="off" 
                                            placeholder="relationship arguments">

                                            <span class="help-block" v-if="errors.has('relationships['+index+'][args]')">@{{ errors.first('relationships['+index+'][args]') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <dir class="box-footer">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </dir>     
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vee-validate"></script>
        <script type="text/javascript">
            Vue.use(VeeValidate);

            var app = new Vue({
                el: '#sectionApp',
                data: {
                    single_name: {!!"'".old('single_name')."'"!!},
                    plural_name: {!!"'".old('plural_name')."'"!!},                  
                    attributes:
                        @if(old('attributes')&& is_array(old('attributes')))
                        {!!collect(old('attributes'))->toJson()!!}
                        @else
                        [{ name: '', type:'', element:'',modifier:'', validate:''}]
                        @endif
                    ,
                    relationships:
                        @if(old('relationships')&& is_array(old('relationships')))
                        {!!collect(old('relationships'))->toJson()!!}
                        @else
                        [{ name: '', type:'', args:''}]
                        @endif
                    ,
                    optionsTypes: {!!collect($types)->toJson()!!},
                    optionsElements: {!!collect($components)->toJson()!!},
                    optionsRelationships: {!!collect($relationships)->toJson()!!}

                        
                },
                methods: {

                    addAttribute(){
                        this.attributes.push({ name: '', type:'', element:'', modifier:'', validate:''});
                    },
                    removeAttribute(){
                        this.attributes.pop();
                    },
                    addRelationship(){
                        this.relationships.push({ name: '', type:'', args:''});
                    },
                    removeRelationship(){
                        this.relationships.pop();
                    },
                    validateBeforeSubmit() {
                        this.$validator.validateAll().then((result) => {
                            if (result) {
                                document.querySelector('#form-section').submit();                               
                            }else{
                                alert('Existen errores en el formulario!!!');
                            }
                        });/*.catch(() => {
                            alert('Existen errores en el formulario!!!');
                        });*/
                    },
                }
            });
            
            @foreach($errors->toArray()?:[] as $key=>$value)
                @php
                $res='';
                if (str_contains($key, '.')) {
                    $keys = explode('.', $key);
                    $res=$keys[0];    
                    foreach (array_slice($keys,1) as $item) {
                        $res = $res.'['.$item.']';
                    }
                }else{
                    $res=$key;
                }
                @endphp

                app.errors.add('{{$res}}', '{{$errors->first($key)}}');
            @endforeach
            
        </script>
        {{ session()->forget('_old_input') }}
    </body>
</html>