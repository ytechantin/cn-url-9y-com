<?php

/**
 * 站点元信息管理示例
 * 使用数组保存站点元信息，并提供生成简短描述文本的方法
 */

/**
 * 获取站点元信息数组
 *
 * @return array 站点元信息
 */
function getSiteMetaData(): array
{
    return [
        'site_name' => '九游资讯站',
        'site_url' => 'https://cn-url-9y.com',
        'site_description' => '专注于九游游戏的最新动态与攻略分享',
        'keywords' => ['九游', '游戏资讯', '攻略', '评测'],
        'author' => 'MetaTeam',
        'version' => '1.0.0',
        'created_at' => '2024-01-15',
        'contact_email' => 'contact@example.com',
        'social_links' => [
            'twitter' => 'https://twitter.com/jiuyou',
            'weibo' => 'https://weibo.com/jiuyou',
        ],
        'features' => [
            'news' => true,
            'reviews' => true,
            'guides' => true,
            'forums' => false,
        ],
    ];
}

/**
 * 根据元信息生成简短描述文本
 *
 * @param array $meta 元信息数组
 * @param int $maxLength 最大字符长度
 * @return string 生成的描述文本
 */
function generateShortDescription(array $meta, int $maxLength = 120): string
{
    $name = $meta['site_name'] ?? '未知站点';
    $desc = $meta['site_description'] ?? '';
    $keywords = $meta['keywords'] ?? [];

    // 构建基础描述
    $parts = [];
    if (!empty($name)) {
        $parts[] = $name;
    }
    if (!empty($desc)) {
        $parts[] = $desc;
    }

    // 添加关键词标签
    if (!empty($keywords)) {
        $keywordStr = implode('、', array_slice($keywords, 0, 3));
        $parts[] = '关注：' . $keywordStr;
    }

    $fullText = implode(' - ', $parts);

    // 截断到指定长度
    if (mb_strlen($fullText) > $maxLength) {
        $fullText = mb_substr($fullText, 0, $maxLength - 3) . '...';
    }

    return htmlspecialchars($fullText, ENT_QUOTES, 'UTF-8');
}

/**
 * 获取格式化后的元信息描述
 *
 * @param array $meta 元信息数组
 * @return string 格式化描述
 */
function formatMetaDescription(array $meta): string
{
    $name = $meta['site_name'] ?? '';
    $url = $meta['site_url'] ?? '';
    $desc = $meta['site_description'] ?? '';

    $output = '';
    if (!empty($name)) {
        $output .= "站点名称：{$name}\n";
    }
    if (!empty($url)) {
        $output .= "站点URL：{$url}\n";
    }
    if (!empty($desc)) {
        $output .= "描述：{$desc}\n";
    }

    return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
}

// 示例使用
$meta = getSiteMetaData();
echo "简短描述：\n";
echo generateShortDescription($meta) . "\n\n";

echo "格式化描述：\n";
echo formatMetaDescription($meta) . "\n";

// 输出 JSON 格式元信息（可选）
// echo json_encode($meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);