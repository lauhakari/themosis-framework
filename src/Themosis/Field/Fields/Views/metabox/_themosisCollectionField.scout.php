<!-- Collection field -->
<div class="themosis-collection-wrapper" data-type="{{ $field['type'] }}" data-limit="{{ $field['limit'] }}" data-order="1" data-name="{{ $field['name'] }}[]" data-field="collection">
    <script id="themosis-collection-item-template" type="text/template">
        <input type="hidden" name="{{ $field['name'] }}[]" value="<%= value %>" data-field="collection"/>
        <div class="themosis-collection__item">
            <div class="centered">
                <img src="<%= src %>" alt="Collection Item"/>
            </div>
            <div class="filename">
                <div><%= title %></div>
            </div>
            <a class="check" title="Remove" href="#">
                <div class="media-modal-icon"></div>
            </a>
        </div>
    </script>
    <?php
        $show = empty($field['value']) ? '' : 'show';
    ?>
    <div class="themosis-collection-container {{ $show }}">
        <!-- Collection -->
        <div class="themosis-collection">
            <ul class="themosis-collection-list">
                @if (!empty($field['value']) && is_array($field['value']))
                    @foreach($field['value'] as $i => $item)
                        <li>
                            {{ Themosis\Facades\Form::hidden($field['name'].'[]', $item, array('data-field' => 'collection', 'data-limit' => 10)) }}
                            <div class="themosis-collection__item">
                                <?php
                                    $isFile = false;
                                    $src = themosis_plugin_url(themosis_path('plugin')).'/src/Themosis/_assets/images/themosisFileIcon.png';

                                    if (wp_attachment_is_image($item))
                                    {
                                        $src = wp_get_attachment_image_src($item, '_themosis_media');
                                        $src = $src[0];
                                    }
                                    else
                                    {
                                        $src = wp_get_attachment_image_src($item, '_themosis_media', true);
                                        $src = $src[0];
                                        $isFile = true;
                                    }
                                ?>
                                <div class="centered">
                                    <img src="{{ $src }}" alt="Collection Item" <?php if ($isFile){ echo('class="icon"'); } ?>/>
                                </div>
                                <div class="filename <?php if ($isFile){ echo('show'); } ?>">
                                    <div>{{ get_the_title($item) }}</div>
                                </div>
                                <a class="check" title="Remove" href="#">
                                    <div class="media-modal-icon"></div>
                                </a>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- End collection -->
    </div>
    <div class="themosis-collection-buttons">
        <button id="themosis-collection-add" type="button" class="button button-primary"><?php _e('Add'); ?></button>
        <button id="themosis-collection-remove" type="button" class="button button-primary themosis-button-remove"><?php _e('Remove'); ?></button>
    </div>
    @if(isset($field['info']))
        <div class="themosis-field-info">
            <p>{{ $field['info'] }}</p>
        </div>
    @endif
</div>
<!-- End collection field -->