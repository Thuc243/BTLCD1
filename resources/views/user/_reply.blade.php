{{-- Recursive reply partial for threaded comments --}}
@php $maxDepth = 4; @endphp

<div class="reply-item" id="review-{{ $reply->id }}" @if($depth > 1) style="margin-left: {{ min($depth * 16, 48) }}px" @endif>
    <div class="reply-header">
        <div class="reply-avatar">{{ strtoupper(substr($reply->user->name, 0, 1)) }}</div>
        <div>
            <div class="reply-author">
                {{ $reply->user->name }}
                @if($reply->user->role === 'admin')
                    <span class="review-badge-admin">Admin</span>
                @endif
                @if($reply->parent && $reply->parent->user)
                    <span class="reply-to-label">
                        <i data-lucide="corner-down-right" size="11"></i>
                        {{ $reply->parent->user->name }}
                    </span>
                @endif
            </div>
            <div class="reply-time">{{ $reply->created_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="reply-content">{{ $reply->content }}</div>
    <div class="reply-actions-row">
        @auth
            @if($depth < $maxDepth)
                <button class="btn-reply-toggle" onclick="toggleReplyForm({{ $reply->id }})">
                    <i data-lucide="corner-down-right" size="13"></i> Trả lời
                </button>
            @endif
            @if(Auth::id() === $reply->user_id || auth()->user()->role === 'admin')
                <form action="{{ route('review.delete', $reply->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                    @csrf @method('DELETE')
                    <button class="btn-review-delete"><i data-lucide="trash-2" size="12"></i> Xóa</button>
                </form>
            @endif
        @endauth
    </div>

    {{-- Reply form for this reply --}}
    @auth
        @if($depth < $maxDepth)
        <div class="reply-form-box" id="replyForm-{{ $reply->id }}" style="display:none">
            <form action="{{ route('review.reply', $reply->id) }}" method="POST" class="reply-form">
                @csrf
                <div class="reply-input-group">
                    <div class="reply-avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <textarea name="content" rows="2" class="reply-textarea" placeholder="Viết phản hồi cho {{ $reply->user->name }}..."></textarea>
                </div>
                <div class="reply-actions">
                    <button type="button" class="btn-reply-cancel" onclick="toggleReplyForm({{ $reply->id }})">Hủy</button>
                    <button type="submit" class="btn-reply-submit"><i data-lucide="send" size="14"></i> Gửi</button>
                </div>
            </form>
        </div>
        @endif
    @endauth

    {{-- Nested replies (recursive) --}}
    @if($reply->replies && $reply->replies->count() > 0 && $depth < $maxDepth)
        @foreach($reply->replies as $childReply)
            @include('user._reply', ['reply' => $childReply, 'depth' => $depth + 1])
        @endforeach
    @endif
</div>
