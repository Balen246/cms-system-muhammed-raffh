
<div class="tab-pane {{  ( Session::get('active_tab') == 'socialTab') ? 'active' : '' }}"
     id="tab-3">
    <div class="p-a-md"><h5><i class="material-icons">&#xe80d;</i>
            &nbsp; {!!  __('backend.siteSocialSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">

        <!-- Dynamic Social Links Management -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <h6>Manage Social Links</h6>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-primary btn-sm" id="addSocialLink">
                        <i class="fa fa-plus"></i> Add Social Link
                    </button>
                </div>
            </div>
        </div>

        <!-- Social Links List -->
        <div id="socialLinksList" class="form-group">
            <!-- Dynamic content will be loaded here -->
        </div>

        <!-- Add/Edit Modal -->
        <div class="modal fade" id="socialLinkModal" tabindex="-1" role="dialog" aria-labelledby="socialLinkModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="socialLinkModalTitle">Add Social Link</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="socialLinkForm">
                            <div class="form-group">
                                <label for="socialLinkName">Name *</label>
                                <input type="text" class="form-control" id="socialLinkName" name="name">
                            </div>
                            <div class="form-group">
                                <label for="socialLinkIcon">Icon Class *</label>
                                <input type="text" class="form-control" id="socialLinkIcon" name="icon_class" 
                                       placeholder="e.g., fa fa-facebook, bi bi-twitter">
                                <small class="form-text text-muted">Use FontAwesome (fa fa-*) or Bootstrap Icons (bi bi-*)</small>
                            </div>
                            <div class="form-group">
                                <label for="socialLinkUrl">URL</label>
                                <input type="url" class="form-control" id="socialLinkUrl" name="url" 
                                       placeholder="https://example.com">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="socialLinkActive" name="is_active" checked> Active
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveSocialLink" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Container -->
        <div id="alertContainer"></div>

    </div>
</div>

@push("after-scripts")
<script>
$(document).ready(function() {
    let isEditing = false;
    let currentEditId = null;

    // Load social links on page load
    loadSocialLinks();

    // Add Social Link button click
    $('#addSocialLink').on('click', function(e) {
        e.preventDefault();
        console.log('Add Social Link button clicked');
        
        isEditing = false;
        currentEditId = null;
        $('#socialLinkModalTitle').text('Add Social Link');
        
        // Clear all form fields manually
        $('#socialLinkName').val('');
        $('#socialLinkIcon').val('');
        $('#socialLinkUrl').val('');
        $('#socialLinkActive').prop('checked', true);
        
        console.log('Form cleared for add mode');
        
        $('#socialLinkModal').modal('show');
    });

    // Save button click handler
    $(document).on('click', '#saveSocialLink', function(e) {
        e.preventDefault();
        console.log('Save button clicked - isEditing:', isEditing, 'currentEditId:', currentEditId);
        
        // Validate form data
        const name = $('#socialLinkName').val().trim();
        const iconClass = $('#socialLinkIcon').val().trim();
        
        if (!name) {
            showAlert('error', 'Name is required');
            return;
        }
        
        if (!iconClass) {
            showAlert('error', 'Icon class is required');
            return;
        }
        
        const formData = {
            name: name,
            icon_class: iconClass,
            url: $('#socialLinkUrl').val().trim(),
            is_active: $('#socialLinkActive').is(':checked')
        };
        
        console.log('Form data:', formData);

        const url = isEditing ? 
            '{{ route("socialLinks.update", ":id") }}'.replace(':id', currentEditId) : 
            '{{ route("socialLinks.store") }}';
        
        console.log('URL:', url);
        
        // Always POST; spoof PUT when editing
        if (isEditing) {
            formData._method = 'PUT';
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                console.log('Success response:', response);
                if (response.success) {
                    $('#socialLinkModal').modal('hide');
                    loadSocialLinks();
                    showAlert('success', response.message);
                } else {
                    showAlert('error', 'Unexpected response format');
                }
            },
            error: function(xhr) {
                console.error('Error response:', xhr);
                const errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : null;
                let errorMessage = 'An error occurred.';
                if (errors) {
                    errorMessage = Object.values(errors).flat().join('<br>');
                }
                showAlert('error', errorMessage);
            }
        });
    });

    // Prevent ALL form submission - we handle it via the save button click
    $(document).on('submit', '#socialLinkForm', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Form submit prevented - handled by save button click');
        return false;
    });
    
    // Also prevent any form submission on the form element itself
    $('#socialLinkForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Direct form submit prevented');
        return false;
    });

    // Load social links
    function loadSocialLinks() {
        $.ajax({
            url: '{{ route("socialLinks.index") }}',
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                displaySocialLinks(response);
            },
            error: function(xhr) {
                showAlert('error', 'Failed to load social links');
            }
        });
    }

    // Display social links
    function displaySocialLinks(socialLinks) {
        let html = '';
        if (socialLinks.length === 0) {
            html = '<div class="alert alert-info">No social links found. Click "Add Social Link" to create one.</div>';
        } else {
            html = '<div class="table-responsive"><table class="table table-striped">';
            html += '<thead><tr><th>Name</th><th>Icon</th><th>URL</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
            
            socialLinks.forEach(function(link) {
                const statusClass = link.is_active ? 'success' : 'secondary';
                const statusText = link.is_active ? 'Active' : 'Inactive';
                
                html += '<tr>';
                html += '<td>' + link.name + '</td>';
                html += '<td><i class="' + link.icon_class + '"></i> ' + link.icon_class + '</td>';
                html += '<td>' + (link.url || '-') + '</td>';
                html += '<td><span class="badge badge-' + statusClass + '">' + statusText + '</span></td>';
                html += '<td>';
                html += '<button class="btn btn-sm btn-primary edit-link" data-id="' + link.id + '" style="width: 80px; margin-bottom: 5px;">Edit</button> ';
                html += '<button class="btn btn-sm btn-' + (link.is_active ? 'warning' : 'success') + ' toggle-status" data-id="' + link.id + '" style="width: 80px; margin-bottom: 5px;">';
                html += link.is_active ? 'Deactivate' : 'Activate';
                html += '</button> ';
                html += '<button class="btn btn-sm btn-danger delete-link" data-id="' + link.id + '" style="width: 80px; margin-bottom: 5px;">Delete</button>';
                html += '</td>';
                html += '</tr>';
            });
            
            html += '</tbody></table></div>';
        }
        
        $('#socialLinksList').html(html);
    }

    // Edit link
    $(document).on('click', '.edit-link', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        
        console.log('Edit button clicked for ID:', id);
        
        isEditing = true;
        currentEditId = id;
        $('#socialLinkModalTitle').text('Edit Social Link');
        
        // Get the icon class from the <i> element's class attribute
        const iconClass = row.find('td:nth-child(2) i').attr('class');
        console.log('Extracted icon class:', iconClass);
        
        // Clear form first, then populate with edit data
        $('#socialLinkName').val('');
        $('#socialLinkIcon').val('');
        $('#socialLinkUrl').val('');
        $('#socialLinkActive').prop('checked', false);
        
        // Populate form fields with edit data
        $('#socialLinkName').val(row.find('td:first').text());
        $('#socialLinkIcon').val(iconClass);
        $('#socialLinkUrl').val(row.find('td:nth-child(3)').text() === '-' ? '' : row.find('td:nth-child(3)').text());
        $('#socialLinkActive').prop('checked', row.find('.badge').hasClass('badge-success'));
        
        console.log('Form populated for editing:', {
            name: $('#socialLinkName').val(),
            icon: $('#socialLinkIcon').val(),
            url: $('#socialLinkUrl').val(),
            active: $('#socialLinkActive').is(':checked')
        });
        
        // Show modal
        console.log('About to show modal...');
        $('#socialLinkModal').modal('show');
        console.log('Modal show called');
    });

    // Toggle status
    $(document).on('click', '.toggle-status', function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '{{ route("socialLinks.toggleStatus", ":id") }}'.replace(':id', id),
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    loadSocialLinks();
                    showAlert('success', response.message);
                }
            },
            error: function(xhr) {
                showAlert('error', 'Failed to update status');
            }
        });
    });

    // Delete link
    $(document).on('click', '.delete-link', function() {
        if (confirm('Are you sure you want to delete this social link?')) {
            const id = $(this).data('id');
            
            $.ajax({
                url: '{{ route("socialLinks.destroy", ":id") }}'.replace(':id', id),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        loadSocialLinks();
                        showAlert('success', response.message);
                    }
                },
                error: function(xhr) {
                    showAlert('error', 'Failed to delete social link');
                }
            });
        }
    });

    // Show alert
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                         message +
                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                         '<span aria-hidden="true">&times;</span></button></div>';
        
        $('#alertContainer').html(alertHtml);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
});
</script>
@endpush
