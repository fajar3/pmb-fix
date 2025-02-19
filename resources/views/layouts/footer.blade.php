<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Kontak Kami</h5>
                <p>{{ $settings['contact_info'] ?? 'Contact info not set' }}</p>
            </div>
            <div class="col-md-4">
                <h5>Alamat</h5>
                <p>{{ $settings['address'] ?? 'Address not set' }}</p>
            </div>
            <div class="col-md-4">
                <h5>Media Sosial</h5>
                <div class="social-links">
                    @if(isset($settings['social_media']))
                        @foreach(json_decode($settings['social_media'], true) as $platform => $link)
                            <a href="{{ $link }}" class="me-2" target="_blank">
                                <i class="bi bi-{{ strtolower($platform) }}"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="text-center">
                    <small>&copy; {{ date('Y') }} Pondok Pesantren Assalam. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>
</footer>